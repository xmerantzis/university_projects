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
public class Donator extends User{
    private Offers offers;
    
    public Donator(String name, String phone){
        super(name, phone);
        this.offers = new Offers();
    }

    public void monitor(){
        offers.monitor();
    }
    
    public List<RequestDonation> getOffers(){
        return offers.getList();
    }
    
    public void modify(int index, double quantity){
        offers.modify(index, quantity);
    }
    
    public void reset(){
        offers.reset();
    }
    public void remove(int index){
        offers.remove(index);
    }
    
    public boolean add(RequestDonation donation, List<Entity> entitiesList){
        return offers.add(donation, entitiesList);
    }
    
    public void commit(RequestDonationList current, List<Entity> entities){
        offers.commit(current, entities);
    }
}
