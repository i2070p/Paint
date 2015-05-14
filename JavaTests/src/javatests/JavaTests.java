/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javatests;

import java.io.BufferedInputStream;
import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.OutputStreamWriter;
import java.io.Serializable;
import java.util.logging.Level;
import java.util.logging.Logger;

class Samolot implements Serializable {
    public String nazwa;
    public Integer iloscSilnikow;
}

class Bombowiec extends Samolot {
    public Integer iloscBomb;
}

public class JavaTests {

    private static final Logger LOG = Logger.getLogger(JavaTests.class.getName());

    public static void Zad1() {
        FileReader in = null;
        FileOutputStream out = null;
        try {
            in = new FileReader("/var/www/Paint/JavaTests/src/javatests/1.xml");
            out = new FileOutputStream("/var/www/Paint/JavaTests/src/javatests/out1.xml");
            int c;
            while ((c = in.read()) != -1) {
                out.write(c);
            }
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }

        }

    }

    public static void Zad2() {
        FileInputStream in = null;
        FileWriter out = null;
        try {
            in = new FileInputStream("/var/www/Paint/JavaTests/src/javatests/1.xml");
            out = new FileWriter("/var/www/Paint/JavaTests/src/javatests/out2.xml");
            int c;
            while ((c = in.read()) != -1) {
                out.write(c);
            }
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }

        }

    }

    public static void Zad3A() {
        FileReader in = null;
        FileOutputStream out = null;
        BufferedReader bufferedIn = null;
        BufferedOutputStream bufferedOut = null;

        try {
            in = new FileReader("/var/www/Paint/JavaTests/src/javatests/1.xml");
            out = new FileOutputStream("/var/www/Paint/JavaTests/src/javatests/out3a.xml");
            bufferedIn = new BufferedReader(in);
            bufferedOut = new BufferedOutputStream(out);
            String line;

            while ((line = bufferedIn.readLine()) != null) {
                bufferedOut.write(line.getBytes());
            }
            bufferedOut.flush();
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (bufferedIn != null) {
                    bufferedIn.close();
                }
                if (bufferedOut != null) {
                    bufferedOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }

        }

    }

    public static void Zad3B() {
        FileInputStream in = null;
        FileWriter out = null;
        BufferedInputStream bufferedIn = null;
        BufferedWriter bufferedOut = null;

        try {
            in = new FileInputStream("/var/www/Paint/JavaTests/src/javatests/1.xml");
            out = new FileWriter("/var/www/Paint/JavaTests/src/javatests/out3b.xml");
            bufferedIn = new BufferedInputStream(in);
            bufferedOut = new BufferedWriter(out);
            int c;

            while ((c = bufferedIn.read()) != -1) {
                bufferedOut.write(c);
            }
            bufferedOut.flush();
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (bufferedIn != null) {
                    bufferedIn.close();
                }
                if (bufferedOut != null) {
                    bufferedOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }

        }

    }

    public static void Zad4() {
        String infile = "/var/www/Paint/JavaTests/src/javatests/1.xml"; // plik wejściowy
        String in_enc = "UTF-8"; // wejściowa strona kodowa
        String outfile = "/var/www/Paint/JavaTests/src/javatests/out4.xml"; // plik wyjściowy
        String out_enc = "Unicode"; // wyjściowa strona kodowa
        FileInputStream in = null;
        FileOutputStream out = null;
        BufferedReader bufferedIn = null;
        BufferedWriter bufferedOut = null;
        try {
            in = new FileInputStream(infile);
            out = new FileOutputStream(outfile);
            bufferedIn = new BufferedReader(new InputStreamReader(in, in_enc));
            bufferedOut = new BufferedWriter(new OutputStreamWriter(out, out_enc));
            String s;
            while ((s = bufferedIn.readLine()) != null) {
                bufferedOut.write(s);
            }
            bufferedOut.flush();
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (bufferedIn != null) {
                    bufferedIn.close();
                }
                if (bufferedOut != null) {
                    bufferedOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }
        }
    }

    public static void Zad5() {
        FileInputStream in = null;
        FileOutputStream out = null;
        DataInputStream dataIn = null;
        DataOutputStream dataOut = null;
        final String path = "/var/www/Paint/JavaTests/src/javatests/arr.txt";
        double[] arr = {7, 8, 9, 10};
        try {

            out = new FileOutputStream(path);
            dataOut = new DataOutputStream(out);
            for (double val : arr) {
                dataOut.writeDouble(val);
            }
            dataOut.flush();

            in = new FileInputStream(path);
            dataIn = new DataInputStream(in);

            while (dataIn.available() > 0) {
                System.out.println(dataIn.readDouble());
            }
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (Exception ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (dataIn != null) {
                    dataIn.close();
                }
                if (dataOut != null) {
                    dataOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }
        }
    }

    public static void Zad6() {
        FileInputStream in = null;
        FileOutputStream out = null;
        ObjectInputStream objectIn = null;
        ObjectOutputStream objectOut = null;
        final String path = "/var/www/Paint/JavaTests/src/javatests/ser.txt";
        double[] arr = {7, 8, 9, 10};
        try {
            out = new FileOutputStream(path);
            objectOut = new ObjectOutputStream(out);
            objectOut.writeObject(arr);

            in = new FileInputStream(path);
            objectIn = new ObjectInputStream(in);
            for (double val : ((double[]) objectIn.readObject())) {
                System.out.println(val);
            }
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (IOException | ClassNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (objectIn != null) {
                    objectIn.close();
                }
                if (objectOut != null) {
                    objectOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }
        }
    }

    public static void Zad7() {
        FileInputStream in = null;
        FileOutputStream out = null;
        ObjectInputStream objectIn = null;
        ObjectOutputStream objectOut = null;
        final String path = "/var/www/Paint/JavaTests/src/javatests/plane.txt";
        Bombowiec plane = new Bombowiec();
        plane.nazwa = "Sztukas";
        plane.iloscSilnikow = 1;
        plane.iloscBomb = 4;
        try {
            out = new FileOutputStream(path);
            objectOut = new ObjectOutputStream(out);
            objectOut.writeObject(plane);

            in = new FileInputStream(path);
            objectIn = new ObjectInputStream(in);
            Bombowiec read = (Bombowiec) objectIn.readObject();
            System.out.println("nazwa: " + read.nazwa + "\niloscBomb: " + read.iloscBomb + "\niloscSilnikow : " + read.iloscSilnikow);
        } catch (FileNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } catch (IOException | ClassNotFoundException ex) {
            LOG.log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (in != null) {
                    in.close();
                }
                if (out != null) {
                    out.close();
                }
                if (objectIn != null) {
                    objectIn.close();
                }
                if (objectOut != null) {
                    objectOut.close();
                }
            } catch (IOException ex) {
                LOG.log(Level.SEVERE, null, ex);
            }
        }
    }

    public static void main(String args[]) {
        Zad1();
        Zad2();
        Zad3A();
        Zad3B();
        Zad4();
        Zad5();
        Zad6();
        Zad7();
    }
}
