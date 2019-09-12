package fr.toulouse.ort.controller;

import java.util.Scanner;

import fr.toulouse.ort.util.Constants;

public class Calculator extends Constants {
	public static void calcul() {
		System.out.println(getMessageInitialisation());
		try (Scanner sc = new Scanner(System.in)){
			while (true) {
				System.out.print(getMessageOperation());
				setRecupDonnees(sc.nextLine());
				if (getRecupDonnees().length() < 5) {
					setErreur(getMessageErreurEspace());
				} else {

					setNbSymbole(0);
					setPositionSymbole(0);
					for (int i = 0; i < getNbrTabSymbole(); i++) {
						setNbSymbole(getNbSymbole() + compterOccurrences(getRecupDonnees(), getTabSymbole()[i]));
						setPositionSymbole(getPositionSymbole() + positionSymbole(getRecupDonnees(), getTabSymbole()[i]));
					}

					if (getNbSymbole() != 1) {
						setErreur(getMessageDeuxEntiers());
					} else {
						for (int i = 0; i < getRecupDonnees().length(); i++) {
							if (i == getPositionSymbole()) {
								if (getRecupDonnees().charAt(i-1) != ' ' || getRecupDonnees().charAt(i+1) != ' '){
									setErreur(getMessageErreurEspace());
								}
							}
						}

						if ("".equals(getErreur())) {

							for (int i = 0; i < getRecupDonnees().length(); i++) {
								if (i < getPositionSymbole() - 1) {
									setMorceau1(getMorceau1() + getRecupDonnees().charAt(i));
								} else if (i > getPositionSymbole() + 1) {
									setMorceau3(getMorceau3() + getRecupDonnees().charAt(i));
								} else if (i == getPositionSymbole()) {
									setMorceau2(getMorceau2() + getRecupDonnees().charAt(i));
								}
							}

							getMorceau1().trim();
							getMorceau2().trim();
							getMorceau3().trim();

							try {
								setNb1(Integer.parseInt(getMorceau1()));
								setNb2(Integer.parseInt(getMorceau3()));
							} catch (Exception e) {
								setErreur(getMessageErreurLogique());
							}
						}
					}
				}

				if (getErreur() != "") {
					System.out.println(getErreur());
				} else {
					setResultat(0);
					for (int i = 0; i < getRecupDonnees().length(); i++) {
						if (getRecupDonnees().charAt(i) == '+') {
							setResultat(getNb1() + getNb2());
						} else if (getRecupDonnees().charAt(i) == '-') {
							setResultat(getNb1() - getNb2());
						} else if (getRecupDonnees().charAt(i) == '*') {
							setResultat(getNb1() * getNb2());
						} else if (getRecupDonnees().charAt(i) == '/') {
							setResultat(getNb1() / getNb2());
						}
					}

					System.out.println(getMessageResultatOperation() + getResultat());
				}

				System.out.println(getMessageRejouer());
				setReponseRejouer(sc.nextLine());
				if ("n".compareTo(getReponseRejouer()) == 0) {
					break;
				} else {
					setMorceau1("");
					setMorceau2("");
					setMorceau3("");
					setErreur("");
				}
			}
		}
		System.out.println(getMessageFermeture());
	}
}
