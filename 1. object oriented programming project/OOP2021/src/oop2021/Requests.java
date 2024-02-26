/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop2021;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

/**
 *
 * @author spiro
 */
public class Requests extends RequestDonationList{
    
    public Requests(){
        super();
    }
    
    
    public boolean add(Beneficiary beneficiary, RequestDonation request, List<Entity> entitiesList, RequestDonationList currentDonations){
        RequestDonation current = currentDonations.get(request.getEntity().getId());
        if(current.getQuantity() > request.getQuantity() && validRequestDonation(request, beneficiary)){
            super.add(request, entitiesList);
            return true;
        }
        
        return false;  
    }
    
    public boolean modify(int index, int quantity,RequestDonation request, List<Entity> entitiesList, RequestDonationList currentDonations, Beneficiary beneficiary){
        RequestDonation current = currentDonations.get(request.getEntity().getId());
        if(current.getQuantity() < request.getQuantity() && validRequestDonation(request, beneficiary)){
            super.modify(index, quantity);
            return true;
        }
       
        return false;     
    }
    
    
    private boolean validRequestDonation(RequestDonation request, Beneficiary beneficiary){
        if(request.getEntity().getClass().getName().contains("Material")){
            Material material = (Material)request.getEntity();
            Iterator<RequestDonation> iterator = beneficiary.getReceived().iterator();
            while(iterator.hasNext()){
                RequestDonation requestDonation = iterator.next();
                if(request.getEntity().equals(requestDonation.getEntity())){
                    return (beneficiary.getNoPersons() == 1 && material.getLevel1() < request.getQuantity() + requestDonation.getQuantity())||
                            (beneficiary.getNoPersons() >= 2 &&  beneficiary.getNoPersons() <= 5 && material.getLevel2() < request.getQuantity() + requestDonation.getQuantity()) ||
                         (beneficiary.getNoPersons() > 5 &&   material.getLevel3() < request.getQuantity() + requestDonation.getQuantity());
                }
            }
        }
        return true;
    }
    
    public void commit(RequestDonationList currentDonations, List<Entity> entitiesList, Beneficiary beneficiary){
        Iterator<RequestDonation> iterator = super.getList().iterator();
        while(iterator.hasNext()){
            RequestDonation request = iterator.next();
            RequestDonation current = currentDonations.get(request.getEntity().getId());
            if(current.getQuantity() > request.getQuantity() && validRequestDonation(request, beneficiary)){
                double newQuantity = currentDonations.get(request.getEntity().getId()).getQuantity() - request.getQuantity();
                currentDonations.get(request.getEntity().getId()).setQuantity(newQuantity);
            }
            else{
                System.err.println("Request"+request+" not valid");
            }
        }
        super.reset();
    }

}
