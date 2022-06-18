// Custom map projection definitions
let source = `PROJCS["GDA94 / SA Lambert",
GEOGCS["GDA94",
    DATUM["Geocentric_Datum_of_Australia_1994",
        SPHEROID["GRS 1980",6378137,298.257222101,
            AUTHORITY["EPSG","7019"]],
        TOWGS84[0,0,0,0,0,0,0],
        AUTHORITY["EPSG","6283"]],
    PRIMEM["Greenwich",0,
        AUTHORITY["EPSG","8901"]],
    UNIT["degree",0.0174532925199433,
        AUTHORITY["EPSG","9122"]],
    AUTHORITY["EPSG","4283"]],
PROJECTION["Lambert_Conformal_Conic_2SP"],
PARAMETER["standard_parallel_1",-28],
PARAMETER["standard_parallel_2",-36],
PARAMETER["latitude_of_origin",-32],
PARAMETER["central_meridian",135],
PARAMETER["false_easting",1000000],
PARAMETER["false_northing",2000000],
UNIT["metre",1,
    AUTHORITY["EPSG","9001"]],
AXIS["Easting",EAST],
AXIS["Northing",NORTH],
AUTHORITY["EPSG","3107"]]`;

let dest = `GEOGCS["WGS 84",
DATUM["WGS_1984",
    SPHEROID["WGS 84",6378137,298.257223563,
        AUTHORITY["EPSG","7030"]],
    AUTHORITY["EPSG","6326"]],
PRIMEM["Greenwich",0,
    AUTHORITY["EPSG","8901"]],
UNIT["degree",0.0174532925199433,
    AUTHORITY["EPSG","9122"]],
AUTHORITY["EPSG","4326"]]`;

// Define heatmap js data
var data = {
    max: 8,
    data: (() => { // Arrow function for scope
        let accloc = load_data('accloc', null); //Get data
        let dataArr = [];
        let inc = 0;

        accloc.forEach(value => { // Loop through all values
            // Proj4 coordinate translation using custom definitions
            let prod = proj4(source, dest, [parseInt(value.acclocx), parseInt(value.acclocy)]);
            // Object of lat, lng, and the count used by heatmapjs
            let element = {
                lat: prod[1],
                lng: prod[0],
                count: 1
            }

            // Push to data array
            dataArr.push(element);
        });

        // Return data array
        return dataArr;
    })()
};

// Initialise map and render base layer
var baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap',
    maxZoom: 18
}
);

// Heatmap js config variable
var cfg = {
    radius: .009,
    maxOpacity: .6,
    blur: 1,
    scaleRadius: true,
    useLocalExtrema: true,
    latField: 'lat',
    lngField: 'lng',
    valueField: 'count',
    gradient: {
        '.5': 'blue',
        '.8': 'red',
        '.95': 'white'
    }
};

// Initialise heatmap js instance
var heatmapLayer = new HeatmapOverlay(cfg);

// Render heatmap as new layer
var map = new L.Map('map', {
    center: new L.LatLng(-34.8663726, 138.512573),
    zoom: 10,
    layers: [baseLayer, heatmapLayer]
});

// Set heatmap data
heatmapLayer.setData(data);