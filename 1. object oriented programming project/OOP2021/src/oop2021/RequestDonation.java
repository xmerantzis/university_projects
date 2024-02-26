/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop2021;

/**
 *
 * @author spiro
 */
public class RequestDonation {
    private Entity entity;
    private double quantity;
    
    public RequestDonation(Entity entity, double quantity){
        this.setEntity(entity);
        this.setQuantity(quantity);
    }
    
    public void setQuantity(double quantity){
        this.quantity = quantity;
    }
    
    public void setEntity(Entity entity){
        this.entity = entity;
    }
    
    public Entity getEntity(){
        return entity;
    }
    
    public double getQuantity(){
        return this.quantity;
    }
    
    public String toString(){
        String det = this.entity+"\t";
        return entity+", Ποσότητα: "+quantity+"\n";
    }
}
