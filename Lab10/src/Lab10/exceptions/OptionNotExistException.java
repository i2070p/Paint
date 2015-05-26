/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Lab10.exceptions;

/**
 *
 * @author meti
 */
public class OptionNotExistException extends Exception {

    public OptionNotExistException(int id) {

        super("Option: " + id + " not exist.");
    }

    public OptionNotExistException(String str) {

        super("Option: " + str + " not exist.");
    }
}
