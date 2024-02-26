/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package oop2021;

import java.util.ArrayList;

/**
 *
 * @author spiro
 */
public class OOP2021 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        Menu.initClass();
        Menu.getOrganization().addEntity(new Material(1,"milk,", "milk", 2, 5, 6));
        Menu.getOrganization().addEntity(new Material(2,"sugar", "sugar", 1, 5, 6));
        Menu.getOrganization().addEntity(new Material(3,"rice", "rice", 7, 8, 9));
         Menu.getOrganization().addEntity(new Service(4,"MedicalSupport", "MedicalSupport"));
         Menu.getOrganization().addEntity(new Service(5,"NurserySupport", "NurserySupport"));
         Menu.getOrganization().addEntity(new Service(6,"BabySitting", "BabySitting"));
        
        Menu.getOrganization().insertDonator(new Donator("Donator 1", "4444"));
        Menu.getOrganization().insertBeneficiary(new Beneficiary("Beneficiary 1", "2222", 3));  
        Menu.getOrganization().insertBeneficiary(new Beneficiary("Beneficiary 2", "3333", 1));  
        Menu.loginUser();
    }
    
}
