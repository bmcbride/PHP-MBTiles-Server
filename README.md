PHP-MBTiles-Server
==================

### About

An extremely simple PHP script for extracting images from an [MBTiles](https://github.com/mapbox/mbtiles-spec) sqlite database file. Examples for use with [Leaflet](http://leaflet.cloudmade.com/) and [OpenLayers](http://openlayers.org/) included.

### Dependencies

- [PHP with PDO_SQLITE enabled](http://php.net/manual/en/ref.pdo-sqlite.php)


### Limitations

This script simply extracts the images from the MBTiles database and DOES NOT support UTFGrid interation!

### Beware!

MBTiles files generated from [TileMill](http://mapbox.com/tilemill/) (currently) use the "TMS" tiling scheme. MapBox hosted tiles (currently) use the "XYZ" tiling scheme. If you use [mbutil](https://github.com/mapbox/mbutil) to export the tile images to a filesystem directory, the default scheme is "XYZ".