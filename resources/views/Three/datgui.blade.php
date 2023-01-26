<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>커스터마이징</title>
		<style>
			body { margin: 0; }
			canvas { display: block; }
		</style>
	</head>
	<body> 
    <div id="container"></div> 

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
      import Stats from 'three/addons/libs/stats.module.js';
			import { GUI } from 'three/addons/libs/lil-gui.module.min.js';
      // 화면 조작
			import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
      // 모델 로더
			import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
      // 모델 익스포터
      import { GLTFExporter } from 'three/addons/exporters/GLTFExporter.js';

      function exportGLTF( input ) {

        const gltfExporter = new GLTFExporter();

        const options = {
          trs: params.trs,
          onlyVisible: params.onlyVisible,
          binary: params.binary,
          maxTextureSize: params.maxTextureSize
        };

        gltfExporter.parse(
          input,
          function ( result ) {
            if ( result instanceof ArrayBuffer ) {
              saveArrayBuffer( result, 'scene.glb' );
            } else {
              const output = JSON.stringify( result, null, 2 );
              console.log( output );
              saveString( output, 'scene.gltf' );
            }
          },
          function ( error ) {
            console.log( 'An error happened during parsing', error );
          },
          options
        );
      }

      const link = document.createElement( 'a' );
			link.style.display = 'none';
			document.body.appendChild( link );

      function save( blob, filename ) {
        link.href = URL.createObjectURL( blob );
        link.download = filename;
        link.click();
        // URL.revokeObjectURL( url ); breaks Firefox...
      }

      function saveString( text, filename ) {
       save( new Blob( [ text ], { type: 'text/plain' } ), filename );
      }

      function saveArrayBuffer( buffer, filename ) {
        save( new Blob( [ buffer ], { type: 'application/octet-stream' } ), filename );
      }


			let scene, renderer, camera, stats;
			let model, skeleton, mixer, clock;

      const params = {
				trs: false,
				onlyVisible: true,
				binary: false,
				maxTextureSize: 4096,
				exportObjects: exportObjects
			};

			// 초기화
			init();

			function init() {
				const container = document.getElementById( 'container' );
        clock = new THREE.Clock();
			
				// scene
				scene = new THREE.Scene();
        scene.background = new THREE.Color( 0xa0a0a0 );
				scene.fog = new THREE.Fog( 0xa0a0a0, 10, 50 );

				// 렌더링 정의 및 크기 지정, 문서에 추가하기
        renderer = new THREE.WebGLRenderer({antialias : true,});
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				renderer.outputEncoding = THREE.sRGBEncoding;
        renderer.shadowMap.enabled = true;
				container.appendChild( renderer.domElement );

				// 카메라 (카메라 수직 시야 각도, 가로세로 종횡비율, 시야거리 시작지점, 시야거리 끝지점)
				camera = new THREE.PerspectiveCamera( 60, window.innerWidth/window.innerHeight, 0.1, 1000 );
				camera.position.set( 0, 7, 10 );
				camera.rotation.x = -35 * ( Math.PI / 180 );
				camera.rotation.y = 35 * ( Math.PI / 180 );

				// 카메라 컨트롤러 추가
				const controls = new OrbitControls (camera, renderer.domElement);
        controls.enablePan = false;
				controls.enableZoom = false;
        controls.target.set( 0, 1, 0 );
				controls.update();

				// 배경 색
				scene.background = new THREE.Color('black');

				// 빛
				const ambientLight = new THREE.AmbientLight( 0xffffff, 0.6 );
				scene.add( ambientLight );

				const directionalLight  = new THREE.DirectionalLight ( 0xffe2b9, 0.4 );
				directionalLight.position.copy( new THREE.Vector3( 2, 4.7, 2 ) );
				scene.add( directionalLight );

				// model
				const onProgress = function ( xhr ) {
          if ( xhr.lengthComputable ) {
            const percentComplete = xhr.loaded / xhr.total * 100;
            console.log( 'model ' + Math.round( percentComplete, 2 ) + '% downloaded' );
        	}
        }
				
        new GLTFLoader().load(
    			'/storage/models/ted/ted.gltf',
    			function (gltf) {
            model = gltf.scene
						scene.add(model);
						// console.log(gltf);

            model.traverse( function ( object ) {
              if ( object.isMesh ) object.castShadow = true;
            });

            // 패널

            // animate()함수를 최초에 한번은 수행해주어야 합니다.
					  animate();
          },
					(xhr) => {
							console.log((xhr.loaded / xhr.total) * 100 + '% loaded')
					},
					(error) => {
							console.log(error)
					}
				);

        // stats = new Stats();
				// container.appendChild( stats.dom );

				// 반응형
				window.addEventListener( 'resize', onWindowResize );

        const gui = new GUI();

				let h = gui.addFolder( 'Settings' );
				h.add( params, 'trs' ).name( 'Use TRS' );
				h.add( params, 'onlyVisible' ).name( 'Only Visible Objects' );
				h.add( params, 'binary' ).name( 'Binary (GLB)' );
				h.add( params, 'maxTextureSize', 2, 8192 ).name( 'Max Texture Size' ).step( 1 );

				h = gui.addFolder( 'Export' );
				h.add( params, 'exportObjects' ).name( 'Export' );

				gui.open();
			}

      function exportObjects() {

        exportGLTF( [ model ] );

      }

			function onWindowResize() {
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );
			}

			
			// 에니메이션 효과를 자동으로 주기 위한 보조 기능입니다.
			function animate() {
				const framesPerSecond = 60;
				setTimeout(function() {
					requestAnimationFrame(animate);
				}, 1000 / framesPerSecond);

				// 랜더링을 수행합니다.
				render();
			}

			function render() {
				renderer.render( scene, camera );
			}

		</script>
	</body>
</html>