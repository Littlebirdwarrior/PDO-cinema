--1.( Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur )
SELECT
    film.titre_film,
    film.annee_sortie_film,
    TIME_FORMAT(SEC_TO_TIME(film.duree_film * 60), "%H:%i") AS duree_film,
    personne.prenom_personne,
    personne.nom_personne
FROM
    film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE
        film.id_film = 1

--2.(Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court )
SELECT
    film.titre_film,
    SEC_TO_TIME(film.duree_film)
FROM
    film
WHERE
    film.duree_film > 135
ORDER BY
    film.duree_film DESC

--3.(Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT DISTINCT
    GROUP_CONCAT(CONCAT_WS(' ', personne.prenom_personne, personne.nom_personne) SEPARATOR ' | ') as realisateur,
    GROUP_CONCAT(CONCAT_WS('-', film.titre_film, film.annee_sortie_film) SEPARATOR ' | ') as film
FROM
    film
        INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
GROUP BY
    realisateur.id_realisateur

--4.(Nombre de films par genre (classés dans l’ordre décroissant)
SELECT genre.libelle_genre, COUNT(film.titre_film) as nombre_film
FROM film
	INNER JOIN genre_film ON genre_film.id_film = film.id_film
	INNER JOIN genre ON genre.id_genre = genre_film.id_genre
GROUP BY genre.id_genre
ORDER BY nombre_film


--5.(Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT personne.nom_personne, COUNT(film.titre_film) as nombre_film
FROM film
	INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
	INNER JOIN personne ON realisateur.id_personne = personne.id_personne
GROUP BY realisateur.id_realisateur
ORDER BY nombre_film DESC

--6.(Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe)
SELECT prenom_personne,
       nom_personne,
       sexe_personne
FROM casting
    INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
    INNER JOIN personne ON acteur.id_personne = personne.id_personne
WHERE casting.id_film = 1

--7.(Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie
-- (du film le plus récent au plus ancien) )
SELECT film.titre_film,
       role.nom_role,
       film.annee_sortie_film
FROM casting
    INNER JOIN film ON casting.id_film = film.id_film
    INNER JOIN role ON casting.id_role = role.id_role
WHERE casting.id_acteur = 2
ORDER BY film.annee_sortie_film DESC


--8.(Listes des personnes qui sont à la fois acteurs et réalisateurs)
SELECT DISTINCT
	p.prenom_personne,
	p.nom_personne
FROM
	personne p
WHERE
	p.id_personne IN(
		SELECT
			r.id_personne FROM realisateur r)
	AND p.id_personne IN(
		SELECT
			a.id_personne FROM acteur a)

--9.(Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
SELECT film.titre_film, film.annee_sortie_film
FROM film
HAVING year(curdate()) - film.annee_sortie_film < 5
ORDER BY film.annee_sortie_film DESC

--10.(Nombre d’hommes et de femmes parmi les acteurs)
SELECT
	p.sexe_personne,
	COUNT(p.nom_personne) AS compte
FROM
	acteur a
	INNER JOIN personne p ON p.id_personne = a.id_personne
GROUP BY
	p.sexe_personne

--11.(Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu))
SELECT
	p.prenom_personne,
	p.nom_personne,
	DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), date_naissance_personne)), '%Y') + 0 AS age
FROM
	acteur a
	INNER JOIN personne p ON a.id_personne = p.id_personne
HAVING
	age > 50
ORDER BY age DESC

--12.(Acteurs ayant joué dans 3 films ou plus )
SELECT
    p.nom_personne,
    COUNT(f.titre_film) AS nombre_film
FROM
    casting c
        INNER JOIN film f ON c.id_film = f.id_film
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
GROUP BY
    c.id_acteur
HAVING
        nombre_film >= 3