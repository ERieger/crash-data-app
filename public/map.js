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

// don't forget to include leaflet-heatmap.js
var data = {
    max: 8,
    data: (() => {
        let accloc = load_data('accloc', null);
        let dataArr = [];
        let inc = 0;

        accloc.forEach(value => {
            if (inc < 50) {
                let prod = proj4(source, dest, [parseInt(value.acclocx), parseInt(value.acclocy)]);
                // console.log(prod);
                // transforming point coordinates
                let element = {
                    lat: prod[1],
                    lng: prod[0],
                    count: 1
                }

                dataArr.push(element);
                // inc++;
            }
        });

        // console.log(dataArr);
        return dataArr;
    })()
};

var baseLayer = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap',
    maxZoom: 18
}
);

var cfg = {
    // radius should be small ONLY if scaleRadius is true (or small radius is intended)
    // if scaleRadius is false it will be the constant radius used in pixels
    radius: .009,
    maxOpacity: .6,
    blur: 1,
    // scales the radius based on map zoom
    scaleRadius: true,
    // if set to false the heatmap uses the global maximum for colorization
    // if activated: uses the data maximum within the current map boundaries
    //   (there will always be a red spot with useLocalExtremas true)
    useLocalExtrema: true,
    // which field name in your data represents the latitude - default "lat"
    latField: 'lat',
    // which field name in your data represents the longitude - default "lng"
    lngField: 'lng',
    // which field name in your data represents the data value - default "value"
    valueField: 'count',
    gradient: {
    // enter n keys between 0 and 1 here
    // for gradient color customization
    '.5': 'blue',
    '.8': 'red',
    '.95': 'white'
  }
};


var heatmapLayer = new HeatmapOverlay(cfg);

var map = new L.Map('map', {
    center: new L.LatLng(-34.8663726, 138.512573),
    zoom: 10,
    layers: [baseLayer, heatmapLayer]
});

heatmapLayer.setData(data);