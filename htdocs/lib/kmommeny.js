$(document).ready(generateMenu);


function generateMenu() {
    /* När användaren klickar på ett menyval ska alla kmom göras osynliga, följt
     * av att det kmom som motsvarar det klickade menyvalet blir synligt. */
    $('.post').hide(); // Dölj alla kmom
    $('.post:first-child').show(); // Visa första kmom

    // Skapa ul-lista
    var kmomlista = "<ul></ul>";

    // Placera ul-lista i kmommenyns contentarea
    $( kmomlista ).appendTo('#kmommeny .contentarea');

    /* Skapa ett ankare för varje rubrik */
    $('.post h3').each(function() {
        /* skapa ankare */
        var ankare = $(this);
        /* trimma bort tabbar och andra onödiga blanksteg. */
        var ankartext = ankare.text().trim();

        /* trimma bort mellansteg. Regex alltså. */
        ankartext = ankartext.replace(/\s+/g, '');
        /* trimma även bort komma-tecken för de pajar allt annars. */
        ankartext = ankartext.replace(/[, ]+/g, '');
        /* lägg till attribut för id för hela <div> (.parent viktig,
         * annars hamnar id-attributet i <h4>-elementet) */
        ankare.parent().attr("id", ankartext);
        /* lägg till attribut för id för hela <a> */
        ankare.wrap('<a id="#' + ankartext + '"/>');
    });

    /* Hämta rubriker och skapa arrayn "rubriker" */
    /* Kör varje <h4>-element genom en funktion */
    var rubriker = $('h3').map(function() {
        return this.innerHTML; // returnerar texten mellan <h4>-taggarna
    });

    /* For-slinga som går igenom alla rubriker i arrayen och
     * skapar en meny med länkar baserad på rubrikerna */
    for (var i=0; i < rubriker.length; i++) {
        /* Ta gällande iteration och skapa variabel */
        var rubrik = rubriker[i];
        // Trimma bort så att den överensstämmer med ankarnas id.
        var rubrikRel = rubrik.replace(/[, ]+/g, '').trim();
        // Skapa li-element med ankarlänk
        var rubrikLista = ('<li><a class="link" href="#' + rubrikRel + '" rel="'
            + rubrikRel + '">' + $.trim(rubrik) + '</li>' );

        // Lägg till li-elementet i ul-listan
        $('#kmommeny ul').append( rubrikLista );
    }
    console.log("for-slinga klar");

    /* När användaren klickar på ett menyval ska alla kmom göras osynliga, följt
     * av att det kmom som motsvarar det klickade menyvalet blir synligt. */
    /* När en länk (identifierad via class="link")
     * klickas kör funktionen som följer: */
    $(".link").click(function() {
        $('.post').hide(); // Dölj alla kmom
        console.log("dölj alla poster");

        var relevantLink = $(this).prop('rel'); // Välj relevant länk

        console.log ("Relevant länk är " + relevantLink);
        $('#' + relevantLink).show(); // Visa vald releveant länk och dess kmom
        console.log("Visa post " + relevantLink);
    });
}
