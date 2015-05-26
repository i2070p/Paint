/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10;

import Lab10.exceptions.OptionNotExistException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;
import lab10.gui.Menu;
import lab10.gui.menu.operations.AddEmployee;
import lab10.gui.menu.operations.Backup;
import lab10.gui.menu.operations.Exit;
import lab10.gui.menu.operations.ListEmployee;
import lab10.gui.menu.operations.RemoveEmployee;
import lab10.persons.Director;
import lab10.persons.Employee;

/**
 *
 * @author meti
 */
public class Lab10 {

    private static final Logger LOG = Logger.getLogger(Lab10.class.getName());

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        Menu menu = new Menu("MENU");

        List<Employee> empls = new ArrayList<>();

       /*empls.add(new Director(1, "AB438H", 2, 3000, "Marek", "Dukaczewski", "23423423"));
        empls.add(new Director(1, "ABggH", 2, 340, "SS", "Dusdfsdewski", "23423423"));
        empls.add(new Director(1, "AsfdH", 2, 3000, "GGG", "Dsdgsdski", "23423423"));
        */
        menu.addSubMenu(new Menu("Lista pracowników", new ListEmployee(empls)));
        menu.addSubMenu(new Menu("Dodaj pracownika", new AddEmployee(empls)));
        menu.addSubMenu(new Menu("Usuń pracownika", new RemoveEmployee(empls)));
        menu.addSubMenu(new Menu("Kopia zapasowa", new Backup(empls)));
        menu.addSubMenu(new Menu("Wyjście", new Exit()));
        while (true) {
            try {
                menu = menu.process();
            } catch (OptionNotExistException ex) {
                LOG.log(Level.WARNING, null, ex);
            } catch (Exception ex) {
                LOG.log(Level.WARNING, null, ex);
            }
        }

    }

}
