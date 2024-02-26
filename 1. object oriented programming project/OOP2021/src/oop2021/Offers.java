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
public class Offers extends RequestDonationList{
    public Offers(){
        super();
    }
    
    public void commit(RequestDonationList currentDonations, List<Entity> entitiesList){
        Iterator<RequestDonation> iterator = super.getList().iterator();
        while(iterator.hasNext()){
            currentDonations.add(iterator.next(), entitiesList);
        }
        super.reset();
    }
}
