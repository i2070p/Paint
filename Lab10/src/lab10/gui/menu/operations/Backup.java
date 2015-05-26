/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package lab10.gui.menu.operations;

import lab10.utils.StreamUtilities;
import Lab10.exceptions.OptionNotExistException;
import java.util.List;
import lab10.gui.Menu;
import lab10.gui.TextField;
import lab10.persons.Employee;

/**
 *
 * @author meti
 */
public class Backup implements Operation {

    protected List<Employee> empls;

    public Backup(List<Employee> empls) {
        this.empls = empls;
    }

    @Override
    public Menu execute(Menu menu, Object... obj) throws Exception {
        String str = new TextField("[Z]achowaj/[O]dzyskaj").readText();
        final String path = "2015-05-27.bkp";
        switch (str) {
            case "Z":
                //path = new TextField("Podaj nazwę:").readText();
                System.out.println("Nazwa pliku: "+path);
                if (this.confirm()) {
                    StreamUtilities.saveListToFile(path, this.empls);
                }
                break;
            case "O":
                //path = new TextField("Podaj nazwę:").readText();
                System.out.println("Nazwa pliku: "+path);
                if (this.confirm()) {
                    StreamUtilities.loadListToFile(path, this.empls);
                }
                break;
            default:
                throw new OptionNotExistException(str);
        }

        return menu.getParent();
    }

    private boolean confirm() throws OptionNotExistException {
        String str = new TextField("[Enter] - potwierdź\n[Q] - porzuć").readLine();

        switch (str) {
            case "":
                return true;
            case "Q":
                return false;
            default:
                throw new OptionNotExistException(str);
        }
    }
}
