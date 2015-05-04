/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javatests;

import java.util.Random;
import javax.swing.JButton;
import sun.java2d.pipe.hw.AccelDeviceEventListener;

/**
 *
 * @author meti
 */
abstract class Example {

    public abstract void transform();
}

class ExtendExample1 extends Example {

    @Override
    public void transform() {
        System.out.println(this.getClass().getSimpleName());
    }

}

class ExtendExample2 extends Example {

    @Override
    public void transform() {
        System.out.println(this.hashCode());
    }

}

interface Figura {

    public void rysuj();
}

class Wielokat implements Figura {

    public void rysuj() {
        System.out.print("Wielokat.rysuj( ) - ");
    }
}

class Elipsa implements Figura {

    public void rysuj() {
        System.out.print("Elipsa.rysuj( ) - ");
    }
}

public class JavaTests {

    public static void main(String args[]) {
        Random random = new Random();

        Figura[] figura = new Figura[9];
        for (int i = 0; i < figura.length; i++) {
            figura[i] = (random.nextInt(2) == 0)
                    ? new Wielokat() : new Elipsa();
        }
        
        for (int i = 0; i < figura.length; i++) {
            if (figura[i] instanceof Wielokat) {
                System.out.println("Wielokat");
            }
            
            if (figura[i] instanceof Elipsa) {
                System.out.println("Elipsa");
            }
        }        

    }
}