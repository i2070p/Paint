package lab10.utils;


import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import lab10.persons.Employee;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author meti
 */
public class StreamUtilities {

    private static final Logger LOG = Logger.getLogger(StreamUtilities.class.getName());

    public static void saveListToFile(String path, List<Employee> empls) throws FileNotFoundException, IOException {
        ObjectOutputStream objectOut = null;
        FileOutputStream out = null;
        try {
            out = new FileOutputStream(path);
            objectOut = new ObjectOutputStream(out);
            objectOut.writeObject(empls);
        } catch (FileNotFoundException ex) {
            throw ex;
        } catch (IOException ex) {
            throw ex;
        } finally {
            try {
                if (out != null) {
                    out.close();
                }
                if (objectOut != null) {
                    objectOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }
        }
    }

    public static void loadListToFile(String path, List<Employee> empls) throws FileNotFoundException, IOException, ClassNotFoundException {
        ObjectInputStream objectIn = null;
        FileInputStream in = null;
        try {
            in = new FileInputStream(path);
            objectIn = new ObjectInputStream(in);

            List<Employee> read = (List<Employee>) objectIn.readObject();
            empls.clear();
            for (Employee emp : read) {
                empls.add(emp);
            }
        } catch (FileNotFoundException ex) {
            throw ex;
        } catch (IOException | ClassNotFoundException ex) {
            throw ex;
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (objectIn != null) {
                    objectIn.close();
                }
            } catch (IOException ex) {
                throw ex;
            }
        }
    }

}
