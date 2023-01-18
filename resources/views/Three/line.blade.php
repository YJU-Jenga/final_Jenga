<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Drawing-Line</title>
		<style>
			body { margin: 0; }
			canvas { display: block; }
		</style>
	</head>
	<body>  
    <!-- https://threejs.org/docs/index.html#manual/ko/introduction/Drawing-lines -->
    <script type="module">
      import * as THREE from 'https://unpkg.com/three/build/three.module.js';
      
      const renderer = new THREE.WebGLRenderer();
      renderer.setSize(window.innerWidth, window.innerHeight);
      document.body.appendChild(renderer.domElement);

      const camera = new THREE.PerspectiveCamera(45, window.innerWidth/window.innerHeight, 1, 500);
      camera.position.set(0, 0, 100);
      camera.lookAt(0, 0, 0);

      const scene = new THREE.Scene();
      
      // 재질
      // LineBasicMaterial, LineDashedMaterial
      const material = new THREE.LineBasicMaterial( { color:0x0000ff } );

      // 꼭짓점
      const points = [];
      points.push(new THREE.Vector3(-10, 10, 0));
      points.push(new THREE.Vector3(0, 20, 0));
      points.push(new THREE.Vector3(10, 10, 0));
      points.push(new THREE.Vector3(3, 10, 0));
      points.push(new THREE.Vector3(3, -3, 0));
      points.push(new THREE.Vector3(-3, -3, 0));
      points.push(new THREE.Vector3(-3, 10, 0));
      points.push(new THREE.Vector3(-10, 10, 0));

      const geometry = new THREE.BufferGeometry().setFromPoints(points);

      const line = new THREE.Line(geometry, material)

      scene.add(line);
      renderer.render(scene, camera);
		</script>
	</body>
</html>