/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop2021;

import java.util.ArrayList;
import java.util.List;
import java.util.Iterator;

/**
 *
 * @author spiro
 */
public class RequestDonationList {
    private List<RequestDonation> rdEntities;
    
    public RequestDonationList(){
        rdEntities = new ArrayList<>();
    }
    
    public RequestDonation get(int id){
        Iterator<RequestDonation> iterator = rdEntities.iterator();
        while(iterator.hasNext()){
            RequestDonation request = iterator.next();
            if(request.getEntity().getId() == id){
                return request;
            }
        } 
        return null;
    }
    
    public List<RequestDonation> getList(){
        return rdEntities;
    }
    
    public boolean add(RequestDonation request, List<Entity> entitiesList){
        Iterator<Entity> iterator = entitiesList.iterator();
        while(iterator.hasNext()){
            Entity ent = iterator.next();
            if(ent.equals(request.getEntity())){
                Iterator<RequestDonation> it2 = rdEntities.iterator();
                while(it2.hasNext()){
                    RequestDonation req = it2.next();
                    if(ent.equals(req.getEntity())){
                        request.setQuantity(request.getQuantity() + req.getQuantity());
                        return true;
                    }
                }
                rdEntities.add(request);
            }
        }
        return true;
    }
    
    public void remove(int index){
        rdEntities.remove(index);
        
    }
    
    public void modify(int index, double quantity){
        rdEntities.get(index).setQuantity(quantity);
    }
    
    
    public void reset(){
        rdEntities.clear();
    }
    
    public void monitor(){
        if(rdEntities.isEmpty()){
            System.out.println("No entities");
        }
        else{
            System.out.println("");
            System.out.println("************************************************");
            System.out.println("***************** Entities **********************");
            System.out.println("************************************************");
            Iterator<RequestDonation> iter = rdEntities.iterator();
            int i = 1;
            while(iter.hasNext()){
                RequestDonation req = iter.next();
                System.out.println("Entity "+i+": "+req.getEntity()+" x"+req.getQuantity());
                i++;
            }
        }

    }
}
