package com.example.hplaptop.icuonwheels;

import android.support.v4.app.FragmentActivity;
import android.os.Bundle;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class MapsActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        LatLng zydus = new LatLng(23.0585, 72.5176);
        LatLng cims = new LatLng(23.0701,72.517);
        LatLng shalby = new LatLng(23.0191, 72.5066);
        LatLng lghos = new LatLng(22.996170,72.599586);
        LatLng sal = new LatLng(23.0495, 72.5242);
        LatLng civil = new LatLng(23.0524, 72.6042);

        mMap.addMarker(new MarkerOptions().position(zydus).title("Zydus Hospital"));
        mMap.addMarker(new MarkerOptions().position(cims).title("CIMS Hospital"));
        mMap.addMarker(new MarkerOptions().position(shalby).title("Shalby Hospital"));
        mMap.addMarker(new MarkerOptions().position(lghos).title("L.G. Hospital"));
        mMap.addMarker(new MarkerOptions().position(sal).title("SAL Hospital"));
        mMap.addMarker(new MarkerOptions().position(civil).title("Civil Hospital"));

        float zoomlevel=12.0f;
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(shalby,zoomlevel));
    }
}
