<!DOCTYPE html>
<html lang="en">
	<head>
		<title>three.js webgl - loaders - GLTF loader</title>
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
      import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
      import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
      import { DRACOLoader } from 'three/addons/loaders/DRACOLoader.js';

			let scene, camera, renderer;
			let mouseX = 0, mouseY = 0;

			// 초기화
			init();
			// animate()함수를 최초에 한번은 수행해주어야 합니다.
			animate();

			function init() {
				const container = document.createElement( 'div' );
				document.body.appendChild( container );
			
				// scene
				scene = new THREE.Scene();

				// 렌더링 정의 및 크기 지정, 문서에 추가하기
        renderer = new THREE.WebGLRenderer({antialias : true,});

				renderer.outputEncoding = THREE.sRGBEncoding;
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );

				container.appendChild( renderer.domElement );

				// 카메라 (카메라 수직 시야 각도, 가로세로 종횡비율, 시야거리 시작지점, 시야거리 끝지점)
				camera = new THREE.PerspectiveCamera( 45, window.innerWidth/window.innerHeight, 0.1, 1000 );
				camera.position.z = 7;
				camera.position.set( 0, 0, 10 );
				camera.position.y = 5;			
				camera.rotation.x = -35 * ( Math.PI / 180 );

				camera.position.x = 5;
				camera.rotation.y = 35 * ( Math.PI / 180 );

				// 카메라 컨트롤러 추가
				const controls = new OrbitControls (camera, renderer.domElement);
				controls.update();

				// 배경 색
				scene.background = new THREE.Color('black');

				// 빛
				const ambientLight = new THREE.AmbientLight( 0xcccccc, 0.4 );
				scene.add( ambientLight );

				const directionalLight  = new THREE.DirectionalLight ( 0xffffff,0.8);
				directionalLight.position.set( - 3, 10, - 10 );
				scene.add( directionalLight );

				// model
				const onProgress = function ( xhr ) {
          if ( xhr.lengthComputable ) {
            const percentComplete = xhr.loaded / xhr.total * 100;
            console.log( 'model ' + Math.round( percentComplete, 2 ) + '% downloaded' );
        	}
        }
				
        new GLTFLoader().load(
    			'/storage/models/coinSilver.glb',
    			function (gltf) {
						scene.add(gltf.scene);
						console.log(gltf);
    			},
					(xhr) => {
							console.log((xhr.loaded / xhr.total) * 100 + '% loaded')
					},
					(error) => {
							console.log(error)
					}
				);

				// 반응형
				window.addEventListener( 'resize', onWindowResize );
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