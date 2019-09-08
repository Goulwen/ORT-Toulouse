
public class Main {

	public static void main(String[] args) {
		// Tableau à trier
		String tab [] = {
				"coucou",
				"salut",
				"allez",
				"zozo",
				"abce",
				"abaa",
				"dalme",
				"mange",
				"boire",
				"coucou",
				"dalme",
				"dalme",
				"mange",
				"test"
		};

		// Affichage du tableau PAS trié
		System.out.println("Tableau avant :");
		for (String words : tab) {
			System.out.print(words + " ");
		}

		/*******************/
		/*******************/
		/*******************/

		/*		TRIE      */

		/*******************/
		/*******************/

		// String temporaire qui stockera la valeur pour switcher
		String tmp;
		
		/*
		// Utilisation de compareTo
		String tmp;
		for (int i = 0; i < tab.length; i++) {
			if(i == 0) {
				continue;
			} else {
				if (tab[i-1].compareTo(tab[i]) > 0) {
					tmp = tab[i-1];
					tab[i-1] = tab[i];
					tab[i] = tmp;
					i = 0;
				} else {
					continue;
				}
			}
		}
		*/

		// Sans utiliser compareTo
		// Variable pour me dire si quand 2 mots commencent même lettre lequel est le 1ier
		int resultat;
		for (int i = 0; i < tab.length; i++) {
			if(i == 0) {
				continue;
			} else {
				// Si la première lettre est pareille
				if (tab[i-1].charAt(0) == tab[i].charAt(0)) {
					resultat = firstWord(tab[i-1], tab[i]);
					// Si > 0 alors faut switcher les 2 mots, si = 0 alors doublon
					if (resultat > 0) {
						tmp = tab[i-1];
						tab[i-1] = tab[i];
						tab[i] = tmp;
						i = 0;
					}
				} // Sinon si la 1iere lettre positive on switch et repart du début
				else if (tab[i-1].charAt(0) > tab[i].charAt(0)) {
					tmp = tab[i-1];
					tab[i-1] = tab[i];
					tab[i] = tmp;
					i = 0;
				} else {
					continue;
				}
			}
		}

		// Sans doublons partie 1
		String tabUnique[] = new String [tab.length];
		// Index pour tabUnique
		int j = 0;
		// Compteur de doublons (calculable avant)
		int k = 0;
		for (int i = 0; i < tab.length; i++) {
			if(i == 0) {
				tabUnique[j] = tab[i];
				j++;
				continue;
			} else {
				resultat = firstWord(tab[i-1], tab[i]);
				// Compte le nombre de doublons
				if (resultat == 0) {
					k++;
					continue;
				} else {
					tabUnique[j] = tab[i];
					j++;
				}
			}
		}
		// Sans doublons partie 2 (enleve case superflues)
		String tabUnique2[] = new String [tab.length - k];
		for (int i = 0; i < tabUnique2.length; i++) {
			tabUnique2[i] = tabUnique[i];
		}



		

		/*******************/
		/*******************/
		/*******************/

		/* 	  FIN TRIE     */

		/*******************/
		/*******************/

		// Affichage du tableau trié
		System.out.println("\nTableau après AVEC doublons :");
		for (String words : tab) {
			System.out.print(words + " ");
		}
		
		// Affichage du tableau trié sans doublons
		System.out.println("\nTableau après SANS doublons:");
		for (String words : tabUnique2) {
			System.out.print(words + " ");
		}

	}

	/**
	 * Fonction pour comparer 2 mots
	 * @param tab1 String le premier mot
	 * @param tab2 String le 2ieme mot
	 * @return int (0 si égal)
	 */
	public static int firstWord(String tab1, String tab2) {
		int resultat = 0;

		for (int i = 0; i < tab1.length(); i++) {
			if (tab1.charAt(i) > tab2.charAt(i)) {
				resultat = 1;
				break;
			} else if (tab1.charAt(i) < tab2.charAt(i)) {
				resultat = -1;
				break;
			} else {
				continue;
			}
		}

		return resultat;
	}

}
