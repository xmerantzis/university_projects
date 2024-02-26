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
public class User {
    private String name;
    private String phone;
    
    public User(){
        this.setName("Sample");
        this.setPhone("11111111");
    }
    
    public User(String name, String phone){
        this.setName(name);
        this.setPhone(phone);
    }
    
    @Override
    public String toString(){
        return this.phone+"\t"+this.name;
    }
    
    public String getPhone(){
        return phone;
    }
    
    public void setName(String name){
        this.name = name;
    }
    
    public void setPhone(String phone){
        this.phone = phone;
    }
    
    public boolean equals(User user){
        if(this.name.equalsIgnoreCase(user.name) && this.phone.equalsIgnoreCase(user.phone)){
            return true;
        }
        else{
            return false;
        }
    }
    
    public boolean equalsWithPhone(String phone){
        if(this.phone.equalsIgnoreCase(phone)){
            return true;
        }
        else{
            return false;
        }
    }
}
