<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>mmd</title>
		<style>
			body { margin: 0; }
			canvas { display: block; }
		</style>
	</head>
	<body>  
		<script type="importmap">
			{
				"imports": {
					"three": "https://unpkg.com/three/build/three.module.js",
					"three/addons/": "https://unpkg.com/three/examples/jsm/"
				}
			}
		</script>
    <script src="https://github.com/kripken/ammo.js"></script>
    <script type="module">
      import * as THREE from 'three';

      import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
      import { OutlineEffect } from 'three/addons/effects/OutlineEffect.js';
      import { MMDLoader } from 'three/addons/loaders/MMDLoader.js';
      import { MMDAnimationHelper } from 'three/addons/animation/MMDAnimationHelper.js';

      let mesh, camera, scene, renderer, effect;

      const clock = new THREE.Clock();

			init();
			animate();

      function init() {
        const container = document.createElement( 'div' );
				document.body.appendChild( container );

        renderer = new THREE.WebGLRenderer( { antialias: true } );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
        
        camera = new THREE.PerspectiveCamera( 45, window.innerWidth/window.innerHeight, 0.1, 1000 );
				camera.position.z = 7;

				camera.position.y = 5;			
				camera.rotation.x = -35 * ( Math.PI / 180 );

				camera.position.x = 5;
				camera.rotation.y = 35 * ( Math.PI / 180 );

        const controls = new OrbitControls (camera, renderer.domElement);
				controls.update();

        scene = new THREE.Scene();
        const listener = new THREE.AudioListener();
				camera.add( listener );
				scene.add( camera );

        const ambient = new THREE.AmbientLight( 0x666666 );
				scene.add( ambient );

        const directionalLight = new THREE.DirectionalLight( 0x887766 );
				directionalLight.position.set( - 1, 1, 1 ).normalize();
				scene.add( directionalLight );

        // Instantiate a loader
        const loader = new MMDLoader();

        // Load a MMD model
        loader.load(
          // path to PMD/PMX file
          '/storage/models/沙花叉クロヱ220607/沙花叉クロヱ220607_3.pmx',
          // called when the resource is loaded
          function ( mesh ) {

            scene.add( mesh );

          },
          // called when loading is in progresses
          function ( xhr ) {

            console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );

          },
          // called when loading has errors
          function ( error ) {

            console.log( 'An error happened' );

          }
        );

        window.addEventListener( 'resize', onWindowResize );
        
      }

      function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
      }

      function animate() {
        requestAnimationFrame( animate );
        render();
      }

      function render() {
        renderer.render( scene, camera );
      }
		</script>
	</body>
</html>