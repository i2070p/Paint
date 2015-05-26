/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui;

import java.util.Scanner;
import lab10.gui.menu.operations.Operation;

/**
 *
 * @author meti
 */
public class TextField extends GUIObject {

    protected String name;

    public TextField(String name, Operation opr) {
        super(opr);
        this.name = name;
    }

    public TextField(String name) {
        super(null);
        this.name = name;
    }

    public String readText() {
        System.out.println(this.toString());
        Scanner sc = new Scanner(System.in);
        return sc.next();
    }

    public int readInt() {
        System.out.println(this.toString());
        Scanner sc = new Scanner(System.in);
        return sc.nextInt();
    }
    
    public String readLine() {
        System.out.println(this.toString());
        Scanner sc = new Scanner(System.in);
        return sc.nextLine();
    }    

    public double readDouble() {
        System.out.println(this.toString());
        Scanner sc = new Scanner(System.in);
        return sc.nextDouble();
    }

    @Override
    public String toString() {
        return this.name + " ";
    }
}
