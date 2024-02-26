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
public class UserInListException extends Exception{
    public UserInListException(){
        super("User already exists");
    }
}
