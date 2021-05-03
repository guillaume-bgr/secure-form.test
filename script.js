$(document).ready(function () {

    let departments = {
        '01': "Ain",
        '02': "Aisne",
        '03': "Allier",
        '04': "Alpes-de-Haute-Provence",
        '06': "Alpes-Maritimes",
        '07': "Ardèche",
        '08': "Ardennes",
        '09': "Ariège",
        '10': "Aube",
        '11': "Aude",
        '12': "Aveyron",
        '67': "Bas-Rhin",
        '13': "Bouches-du-Rhône",
        '14': "Calvados",
        '15': "Cantal",
        '16': "Charente",
        '17': "Charente-Maritime",
        '18': "Cher",
        '19': "Corrèze",
        '2A': "Corse-du-Sud",
        '21': "Côte-d'Or",
        '22': "Côtes-d'Armor",
        '23': "Creuse",
        '79': "Deux-Sèvres",
        '24': "Dordogne",
        '25': "Doubs",
        '26': "Drôme",
        '91': "Essonne",
        '27': "Eure",
        '28': "Eure-et-Loir",
        '29': "Finistère",
        '30': "Gard",
        '32': "Gers",
        '33': "Gironde",
        '971': "Guadeloupe",
        '973': "Guyane",
        '05': "Hautes-Alpes",
        '65': "Hautes-Pyrénées",
        '2B': "Haute-Corse",
        '31': "Haute-Garonne",
        '43': "Haute-Loire",
        '52': "Haute-Marne",
        '70': "Haute-Saône",
        '74': "Haute-Savoie",
        '87': "Haute-Vienne",
        '92': "Hauts-de-Seine",
        '68': "Haut-Rhin",
        '34': "Hérault",
        '35': "Ille-et-Vilaine",
        '36': "Indre",
        '37': "Indre-et-Loire",
        '38': "Isère",
        '39': "Jura",
        '40': "Landes",
        '974': "La Réunion",
        '42': "Loire",
        '45': "Loiret",
        '44': "Loire-Atlantique",
        '41': "Loir-et-Cher",
        '46': "Lot",
        '47': "Lot-et-Garonne",
        '48': "Lozère",
        '49': "Maine-et-Loire",
        '50': "Manche",
        '51': "Marne",
        '972': "Martinique",
        '53': "Mayenne",
        '976': "Mayotte",
        '54': "Meurthe-et-Moselle",
        '55': "Meuse",
        '56': "Morbihan",
        '57': "Moselle",
        '58': "Nièvre",
        '59': "Nord",
        '60': "Oise",
        '61': "Orne",
        '75': "Paris",
        '62': "Pas-de-Calais",
        '63': "Puy-de-Dôme",
        '64': "Pyrénées-Atlantiques",
        '66': "Pyrénées-Orientales",
        '69': "Rhône",
        '71': "Saône-et-Loire",
        '72': "Sarthe",
        '73': "Savoie",
        '93': "Seine-Saint-Denis",
        '76': "Seine-Maritime",
        '77': "Seine-et-Marne",
        '80': "Somme",
        '81': "Tarn",
        '82': "Tarn-et-Garonne",
        '90': "Territoire de Belfort",
        '94': "Val-de-Marne",
        '95': "Val-d'Oise",
        '83': "Var",
        '84': "Vaucluse",
        '85': "Vendée",
        '86': "Vienne",
        '88': "Vosges",
        '89': "Yonne",
        '78': "Yvelines",
    }

    // Interroge l'api avec ce qui est entré dans le champ d'adresse pour avoir des options d'autocomplétion
    // Quand on relâche une touche du clavier
    $('#address').keyup(function () {
        // On supprime les options d'autocomplétion précédemment ajoutées
        $('.list-group-item').remove();
        // On prend la valeur du champ
        let search = $(this).val();
        // On remplace les espaces par des + pour les paramètres d'url
        search.replace(' ', '+');
        // On interroge l'api pour avoir cinq résultats
        let address = "https://api-adresse.data.gouv.fr/search/";
        let answer = $.getJSON(address, {
            "q": search,
            "&limit": '5',
        });
        // Pour chaque résultat on prend le label(l'adresse) et on l'ajoute à la liste d'autocomplétion
        answer.done(function (data) {
            let i = 0;
            $.each(data, function () {
                console.log(data.features[i].properties.label);
                $('.list-group.address').append('<li class="list-group-item">' + data.features[i].properties.label + '</li>');
                i += 1;
            })
        });
    });

    // Autocomplétion du champ d'adresse au clic
    $(document).on('click', '.list-group.address .list-group-item', function () {
        $('#address').val($(this).text());
        // On vide la liste d'autocomplétion une fois qu'elle est cliquée
        $('.list-group').empty();
    })


    // Même manoeuvre pour le lieu de naissance
    $('#birthplace').keyup(function () {
        $('.list-group-item').remove();
        let search = $(this).val();
        search.replace(' ', '+');
        let birthplace = "https://api-adresse.data.gouv.fr/search/?type=municipality";
        let answerBirthplace = $.getJSON(birthplace, {
            q: search,
            limit: "5",
        });
        answerBirthplace.done(function (data) {
            let i = 0;
            $.each(data, function () {
                console.log(data.features[i].properties.label);
                $('.list-group.birthplace').append('<li class="list-group-item" data-department="' + data.features[i].properties.id.slice(0, 2) + '">' + data.features[i].properties.label + '</li>');
                i += 1;
            })
        });
    });
    $(document).on('click', '.list-group.birthplace     .list-group-item', function () {
        $('#birthplace').val($(this).text());
        if ($(this).attr('data-department') in departments) {
            $('#birthdepartment').val(departments[$(this).attr('data-department')] + " (" + $(this).attr('data-department') + ")")
        }
        $('.list-group.birthplace').empty();
        $('#birthstate').val('France');
        $('#nationality').val('Française');
    });

    let increment = 1;
    // Ajouter un champ de diplôme
    $('.add-cert').click(function() {
        increment = increment + 1;
        $('.cert').append('<input type="text" class="form-control" id="certificates'+increment+'" name="certificates'+increment+'" placeholder="'+increment+'ème diplôme">');
    });

    // Ajouter une personne à appeler en cas d'urgence
    $('.add-emergency').click(function() {
        let clone = $('.emergency-person').clone();
        $('.emergency-person').after(clone);
    });



});