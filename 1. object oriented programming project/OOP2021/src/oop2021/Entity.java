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
public abstract class Entity {
    private int id;
    private String name;
    private String description;

    
    public Entity(int id,String name, String description){
        setId(id);
        setName(name);
        setDescription(description);
    }
    
    private void setId(int id){
        this.id = id;
    }
    
    private void setName(String name){
        this.name = name;
    }
    
    private void setDescription(String description){
        this.description = description;
    }
    
    public String getEntityInfo(){
        return "Id: "+id+", Όνομα: "+name+", Περιγραφή: "+description+"\n";
    }
    
    public int getId(){
        return id;
    }
    
    public String getName(){
        return name;
    }
    
    @Override
    public String toString(){
        return "ID: "+id+"\t"+name+"\t"+description+"\t"+this.getDetails();
    }
    
    public boolean equals(Entity entity){
        if(this.id == entity.id){
            return true;
        }
        else{
            return false;
        }
    }
    
    public abstract String getDetails();
}
