$(document).ready(function() {
    const $search = $('#search');
    const $resultats = $('#resultats');
    let timeout = null;

    // Fonction pour formater les résultats
    function formatResult(item) {
        return `
        <li class="list-group-item clickable-item" data-nom="${item.nom}">
            <span class="med-name">${item.nom}</span>
            <span class="med-desc d-block">${item.description}</span>
        </li>`;
    }

    // Recherche avec délai pour éviter trop de requêtes
    $search.on('input', function() {
        clearTimeout(timeout);
        const terme = $(this).val().trim();

        if (terme.length === 0) {
            $resultats.empty().removeClass('show');
            return;
        }

        timeout = setTimeout(() => {
            $resultats.empty().addClass('show');
            
            $.get('../controller/MedicamentController.php', { search: terme })
                .done(function(data) {
                    if (data.length === 0) {
                        $resultats.append('<li class="list-group-item no-results">Aucun médicament trouvé</li>');
                    } else {
                        data.forEach(item => {
                            $resultats.append(formatResult(item));
                        });
                    }
                })
                .fail(function() {
                    $resultats.append('<li class="list-group-item no-results">Erreur de connexion au serveur</li>');
                });
        }, 300); // Délai de 300ms après la dernière frappe
    });

    // Gestion du clic sur un résultat
    $resultats.on('click', '.clickable-item', function() {
        const nomMedicament = $(this).data('nom');
        $search.val(nomMedicament).focus();
        $resultats.empty().removeClass('show');
    });

    // Fermer les résultats quand on clique ailleurs
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.position-relative').length) {
            $resultats.removeClass('show');
        }
    });

    // Animation lors de l'affichage des résultats
    $search.on('focus', function() {
        if ($resultats.children().length > 0) {
            $resultats.addClass('show');
        }
    });
});