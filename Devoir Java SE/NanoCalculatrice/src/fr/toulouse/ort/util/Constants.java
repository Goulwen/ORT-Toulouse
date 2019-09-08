package fr.toulouse.ort.util;

public class Constants {
	private static String nomInitialisation = "CALCULATRICE";
	private static String initialisation = initCalculette();

	private static String messageInitialisation = initialisation + "\n" + nomInitialisation + "\n" + initialisation;
	private static String messageOperation = "Ton opération : ";
	private static String messageErreurEspace = "Utilise les espaces sinon je ne peux pas faire le calcul !";
	private static String messageErreurLogique = "Ton opération n'est pas logique !";
	private static String messageDeuxEntiers = "Navré mais je ne peux que faire des opérations à 2 entiers...";
	private static String messageResultatOperation = "Résultat de l'opération : ";
	private static String messageRejouer = "Veux-tu effectuer une nouvelle opération ? [On]";
	private static String messageFermeture = "La calculatrice a bien été fermée ! ;)";

	// morceau recup utilisateur a mis
	private static String morceau1 = "";
	private static String morceau2 = "";
	private static String morceau3 = "";

	// Nombre de l'utilisateur
	private static int nb1 = 0;
	private static int nb2 = 0;

	private static String recupDonnees;
	private static String erreur = "";

	// Les différentes opérations possibles
	private static char tabSymbole [] = {'+', '-', '*', '/'};
	private static int nbrTabSymbole = tabSymbole.length;
	

	private static int nbSymbole;
	private static int positionSymbole;

	private static int resultat;

	private static String reponseRejouer;
	
	
	// METHODES
	private static String initCalculette() {
		String tiret = "";
		for (int i = 0; i < nomInitialisation.length(); i++) {
			tiret += "-";
		}
		return tiret;
	}
	
	public static int compterOccurrences(String maChaine, char recherche)
	{
		int nb = 0;
		for (int i=0; i < maChaine.length(); i++)
		{
			if (maChaine.charAt(i) == recherche)
				nb++;
		}
		return nb;
	}

	public static int positionSymbole(String maChaine, char recherche)
	{
		int nb = 0;
		for (int i=0; i < maChaine.length(); i++)
		{
			if (maChaine.charAt(i) == recherche)
				nb = i;
		}
		return nb;
	}
	
	// GETTER/SETTER

	public static String getNomInitialisation() {
		return nomInitialisation;
	}

	public static void setNomInitialisation(String nomInitialisation) {
		Constants.nomInitialisation = nomInitialisation;
	}

	public static String getMessageInitialisation() {
		return messageInitialisation;
	}

	public static void setMessageInitialisation(String messageInitialisation) {
		Constants.messageInitialisation = messageInitialisation;
	}

	public static String getMessageOperation() {
		return messageOperation;
	}

	public static void setMessageOperation(String messageOperation) {
		Constants.messageOperation = messageOperation;
	}

	public static String getMessageErreurEspace() {
		return messageErreurEspace;
	}

	public static void setMessageErreurEspace(String messageErreurEspace) {
		Constants.messageErreurEspace = messageErreurEspace;
	}

	public static String getMessageErreurLogique() {
		return messageErreurLogique;
	}

	public static void setMessageErreurLogique(String messageErreurLogique) {
		Constants.messageErreurLogique = messageErreurLogique;
	}

	public static String getMessageDeuxEntiers() {
		return messageDeuxEntiers;
	}

	public static void setMessageDeuxEntiers(String messageDeuxEntiers) {
		Constants.messageDeuxEntiers = messageDeuxEntiers;
	}

	public static String getMessageResultatOperation() {
		return messageResultatOperation;
	}

	public static void setMessageResultatOperation(String messageResultatOperation) {
		Constants.messageResultatOperation = messageResultatOperation;
	}

	public static String getMessageRejouer() {
		return messageRejouer;
	}

	public static void setMessageRejouer(String messageRejouer) {
		Constants.messageRejouer = messageRejouer;
	}

	public static String getMessageFermeture() {
		return messageFermeture;
	}

	public static void setMessageFermeture(String messageFermeture) {
		Constants.messageFermeture = messageFermeture;
	}

	public static String getMorceau1() {
		return morceau1;
	}

	public static void setMorceau1(String morceau1) {
		Constants.morceau1 = morceau1;
	}

	public static String getMorceau2() {
		return morceau2;
	}

	public static void setMorceau2(String morceau2) {
		Constants.morceau2 = morceau2;
	}

	public static String getMorceau3() {
		return morceau3;
	}

	public static void setMorceau3(String morceau3) {
		Constants.morceau3 = morceau3;
	}

	public static int getNb1() {
		return nb1;
	}

	public static void setNb1(int nb1) {
		Constants.nb1 = nb1;
	}

	public static int getNb2() {
		return nb2;
	}

	public static void setNb2(int nb2) {
		Constants.nb2 = nb2;
	}

	public static String getRecupDonnees() {
		return recupDonnees;
	}

	public static void setRecupDonnees(String recupDonnees) {
		Constants.recupDonnees = recupDonnees;
	}

	public static String getErreur() {
		return erreur;
	}

	public static void setErreur(String erreur) {
		Constants.erreur = erreur;
	}

	public static char[] getTabSymbole() {
		return tabSymbole;
	}

	public static void setTabSymbole(char[] tabSymbole) {
		Constants.tabSymbole = tabSymbole;
	}

	public static int getNbrTabSymbole() {
		return nbrTabSymbole;
	}

	public static void setNbrTabSymbole(int nbrTabSymbole) {
		Constants.nbrTabSymbole = nbrTabSymbole;
	}

	public static int getNbSymbole() {
		return nbSymbole;
	}

	public static void setNbSymbole(int nbSymbole) {
		Constants.nbSymbole = nbSymbole;
	}

	public static int getPositionSymbole() {
		return positionSymbole;
	}

	public static void setPositionSymbole(int positionSymbole) {
		Constants.positionSymbole = positionSymbole;
	}

	public static int getResultat() {
		return resultat;
	}

	public static void setResultat(int resultat) {
		Constants.resultat = resultat;
	}

	public static String getReponseRejouer() {
		return reponseRejouer;
	}

	public static void setReponseRejouer(String reponseRejouer) {
		Constants.reponseRejouer = reponseRejouer;
	}

}
