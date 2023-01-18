<!DOCTYPE html>
<html lang="en">
	<head>
		<title>three.js webgl - loaders - OBJ loader</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
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

		<script type="module">

			import * as THREE from 'three';

      import { MTLLoader } from 'three/addons/loaders/MTLLoader.js';
			import { OBJLoader } from 'three/addons/loaders/OBJLoader.js';

			let camera, scene, renderer;

			let mouseX = 0, mouseY = 0;

			let windowHalfX = window.innerWidth / 2;
			let windowHalfY = window.innerHeight / 2;

			init();
			animate();


			function init() {

				const container = document.createElement( 'div' );
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
				camera.position.z = 0;

				// scene

				scene = new THREE.Scene();

				const ambientLight = new THREE.AmbientLight( 0xcccccc, 0.4 );
				scene.add( ambientLight );

				const pointLight = new THREE.PointLight( 0xffffff, 0.8 );
				camera.add( pointLight );
				scene.add( camera );

				// model

				const onProgress = function ( xhr ) {

          if ( xhr.lengthComputable ) {

            const percentComplete = xhr.loaded / xhr.total * 100;
            console.log( 'model ' + Math.round( percentComplete, 2 ) + '% downloaded' );

        }

        }

        new MTLLoader()
					.setPath( '/storage/models/girl-blend/' )
					.load( 'Girl.mtl', function ( materials ) {
						materials.preload();

						new OBJLoader()
							.setMaterials( materials )
							.setPath( '/storage/models/girl-blend/' )
							.load( 'Girl.obj', function ( object ) {

								object.position.y = 0;
								scene.add( object );

							}, onProgress );

					} );

        renderer = new THREE.WebGLRenderer();
				renderer.outputEncoding = THREE.sRGBEncoding;
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				document.addEventListener( 'mousemove', onDocumentMouseMove );

				//

				window.addEventListener( 'resize', onWindowResize );

			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function onDocumentMouseMove( event ) {

				mouseX = ( event.clientX - windowHalfX ) / 2;
				mouseY = ( event.clientY - windowHalfY ) / 2;

			}

			//

			function animate() {

				requestAnimationFrame( animate );
				render();

			}

			function render() {

				camera.position.x += ( mouseX - camera.position.x ) * .05;
				camera.position.y += ( - mouseY - camera.position.y ) * .05;

				camera.lookAt( scene.position );

				renderer.render( scene, camera );

			}

		</script>

	</body>
</html>