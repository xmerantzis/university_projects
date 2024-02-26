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
public class Material extends Entity{
    private double level1;
    private double level2;
    private double level3;
    
    public Material(int id,String name, String description, double level1, double level2, double level3){
        super(id, name, description);
        this.level1 = level1;
        this.level2 = level2;
        this.level3 = level3;
    }

    @Override
    public String getDetails() {
        return "Material Level 1: "+level1+", Level 2: "+level2+" , Level 3: "+level3+"\n";
    }
    
    public double getLevel1(){
        return level1;
    }
    
    public double getLevel2(){
        return level2;
    }
    
    public double getLevel3(){
        return level3;
    }
}
