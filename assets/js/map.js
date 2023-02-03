console.log('map coming soon')

// On initialise la latitude et la longitude de Paris (centre de la carte)
var lat = 46.1122;
var lon = 4.87109;
var myMap = null;
import L from 'leaflet';

// Pour une raison obscure, lorsque nous utilisons Webpack, nous devons redéfinir les icons
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png'),
});

require('leaflet-easybutton');
require('@ansur/leaflet-pulse-icon');

import horseIconImage from "/assets/images/icons-horse-stable.png"
var horseIcon = L.icon({
    iconUrl: horseIconImage,  
});

const horseLocations = document.getElementsByClassName('horseLocation');

var markers = []; // Nous initialisons la liste des marqueurs

// Fonction d'initialisation de la carte
function initMap() {
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    myMap = L.map('map').setView([lat, lon], 11);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
    }).addTo(myMap);

    // var marker = L.marker([lat, lon]).addTo(myMap);

    for (const location of horseLocations) {
        var marker = L.marker([location.dataset.lat, location.dataset.lng], {icon: horseIcon}).addTo(myMap);
        marker.bindPopup("<b>" + location.dataset.name + "</b><br>" + location.dataset.service).openPopup();
        markers.push(marker); // Nous ajoutons le marqueur à la liste des marqueurs
    }  

    var group = new L.featureGroup(markers); // Nous créons le groupe des marqueurs pour adapter le zoom
	myMap.fitBounds(group.getBounds().pad(0.5)); // Nous demandons à ce que tous les marqueurs soient visibles, et ajoutons un padding (pad(0.5)) pour que les marqueurs ne soient pas coupés
}

window.onload = function () {
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();
};
