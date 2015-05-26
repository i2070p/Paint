/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.persons;

/**
 *
 * @author meti
 */
public class EmployeeFactory {

    public static Employee create(String s) {
        Employee result = null;

        switch (s) {
            case "H":
                result = new Trader();
                break;
            case "D":
                result = new Director();
                break;
        }
        
        return result;
    }

}
