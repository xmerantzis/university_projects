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
public class Service extends Entity{
    public Service(int id,String name, String description){
        super(id, name, description);
    }

    @Override
    public String getDetails() {
        return "\tService";
    }
}
