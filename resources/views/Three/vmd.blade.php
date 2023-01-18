<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>mmd</title>
		<style>
			body { margin: 0;}
			canvas { display: block; }
		</style>
	</head>
	<body>  
    <div style="display: flex; flex-direction:column; align-items: center; margin-top: 10vh;">
      <div id='webgl' style="width: 40%;"></div>
      <div>
        <div><h1>텍스트 박스 위치</h1></div>
      </div>
      <form name="form1" style="text-align: center; width: 40%;">
        <label for="label1" style="display: block; padding: 0 10%; text-align: left;"><b>テキスト入力&nbsp;（ひらがな, カタカナ）</b></label>
        <textarea name="textarea1" id="label1" style="height: 50px; width: 80%; resize: none;"></textarea><br />
        <br />
        <button type="button" name="button1">口パク</button>
      </form>
    </div>
		<script type="importmap">
			{
				"imports": {
					"three": "https://unpkg.com/three/build/three.module.js",
					"three/addons/": "https://unpkg.com/three/examples/jsm/"
				}
			}
		</script>
    <script src="/storage/js/mmdparser.js"></script>
    <script type="module">
      import * as THREE from 'three';
      import { MMDToonShader } from 'three/addons/shaders/MMDToonShader.js';
      import { MMDLoader } from 'three/addons/loaders/MMDLoader.js';
      import { TGALoader } from 'three/addons/loaders/TGALoader.js';
      import { OutlineEffect } from 'three/addons/effects/OutlineEffect.js';
      import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
      
      // import { MMDAnimationHelper } from 'three/addons/animation/MMDAnimationHelper.js';

      let camera, controls, effect, light, mesh, renderer, scene;
      let canvasSizeW = parseInt(window.getComputedStyle(document.getElementById('webgl')).width);
      let canvasSizeH = parseInt(window.getComputedStyle(document.getElementById('webgl')).width) * 540 / 960;

      // 표정(morph)의 애니메이션에 관련한 변수
      const frameNumber = 4;
      const frameRate = 24;
      const morphValue = 0.5;

      // 메인 프로그램
      document.addEventListener('DOMContentLoaded', function(){
        // (1) 장면(scene) 준비
        prepareScene();
        // (2) MMD 3D 모델 로드, 장면에 추가
        loadMMD();
        // (3) 렌더링
        sceneRender();
      }, false);

      // (1) 장면(scene) 준비
      function prepareScene() {
        // 렌더러 작성
        // (Constructor) WebGLRenderer( parameters : Object ) : Renederer
        renderer = new THREE.WebGLRenderer({antialias: true});
        // 해상도 설정
        // (Method) .setPixelRatio ( value : number ) : null
        renderer.setPixelRatio(window.devicePixelRatio);
        // 캔버스 사이즈 설정
        // (Method) .setSize ( width : Integer, height : Integer, updateStyle : Boolean ) : null
        renderer.setSize(canvasSizeW, canvasSizeH);
        // 배경색, 투명도 설정
        // (Method) .setClearColor ( color : Color, alpha : Float ) : null
        renderer.setClearColor( 0xffffff, 1.0 );
        // 그림자 매핑
        // (Property) .shadowMap.enabled : Boolean
        renderer.shadowMap.enabled = true;
        // 그림자 매핑의 타입을 지정
        // (Property) .shadowMap.type : Integer
        // THREE.BasicShadowMap、THREE.PCFShadowMap (default)、THREE.PCFSoftShadowMap、THREE.VSMShadowMap 중에 선택
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        // 렌더러의 출려지의 HTML 요소 설정 (canvas는 자동생성)
        // (Property) .domElement : DOMElement
        document.getElementById( 'webgl' ).appendChild( renderer.domElement );

        // OutlineEffect 적용
        // (Constructor) OutlineEffect( renderer, parameters : Object ) : Effect
        effect = new OutlineEffect( renderer );

        // 장면(scene)을 작성
        // (Constructor) Scene() : Object3D
        scene = new THREE.Scene();

        // 빛(환경광) 작성 후、장면에 추가
        // (Method) .add ( object : Object3D, ... ) : this
        // (Constructor) AmbientLight( color : Integer, intensity : Float ) : Object3D -> Light
        scene.add( new THREE.AmbientLight( 0xffffff, 0.6 ) );

        // 빛(평행광원) 작성
        // (Constructor)  DirectionalLight( color : Integer, intensity : Float ) : Object3D -> Light
        light = new THREE.DirectionalLight( 0xffe2b9, 0.4 );
        // 빛(평행광원) 에의한 동적 그림자를 그리기 위한 설정
        // (Property) .castShadow : Boolean
        light.castShadow = true;
        // 빛의 위치를 설정
        // (Property) .position : Vector3
        // (Method) .copy ( v : Vector3 ) : this
        light.position.copy( new THREE.Vector3( 2, 4.7, 2 ) );
        // 빛(스포트라이트 광원)에의한 그림자 매핑의 사이즈
        // (Property) .shadow : SpotLightShadow
        // (Property) .mapSize : Vector2
        light.shadow.mapSize.copy( new THREE.Vector2 ( 2 ** 10, 2 ** 10 ) );
        // 빛(스포트라이트 광원)에의한 그림자의 해상도
        // (Property) .shadow : SpotLightShadow
        // (Property) .focus : Number
        light.shadow.focus = 1;
        // Shadow Map의 offset bias 설정、Shadow Acne를 줄일 수 있다.
        // (Property) .normalBias : Float
        light.shadow.normalBias = 0.02;
        // Shadow Map의 bias 설정、그림자 속에 생기는 Artefacts를 줄일 수 있다.
        // (Property) .bias : Float
        light.shadow.bias = -0.0005;

        // 평행광원 설정
        // (Property) .shadow : SpotLightShadow
        // (Property) .camera : Camera
        // (Property) .left : Float
        light.shadow.camera.left = -5;
        // (Property) .right : Float
        light.shadow.camera.right = 5;
        // (Property) .top : Float
        light.shadow.camera.top = 5;
        // (Property) .bottom : Float
        light.shadow.camera.bottom = -5;
        // (Property) .near : Float
        light.shadow.camera.near = 0.1;
        // (Property) .far : Float
        light.shadow.camera.far = 20;

        // 빛(평행광원)을 장면(scene)에 추가
        // (Method) .add ( object : Object3D, ... ) : this
        scene.add( light );
        //light.target.position.copy( new THREE.Vector3( 0, 0, 0 ) );
        // 평행광원의 타겟을 장면(scene)에 추가
        // (Method) .add ( object : Object3D, ... ) : this
        scene.add( light.target );
        // 카메라를 작성
        // (Constructor) PerspectiveCamera( fov : Number, aspect : Number, near : Number, far : Number ) : Object3D -> Camera
        // 화각을 결정하는 종횡비 16:9에서의 초점거리(35mm 판 상당)와 수직 화각은 다음과 같다.
        // 24 mm = 45.75、 35 mm = 32.27、50 mm = 22.90
        camera = new THREE.PerspectiveCamera( 22.9, canvasSizeW / canvasSizeH, 0.1, 20 );

        // OrbitControls를 사용하기 위한 설정
        // (Constructor) OrbitControls( object : Camera, domElement : HTMLDOMElement ) : Controls
        controls = new OrbitControls( camera, renderer.domElement );

        // 바닥을 작성
        // (Constructor) Mesh( geometry : BufferGeometry, material : Material ) : Object3D
        // (Constructor) PlaneGeometry(width : Float, height : Float, widthSegments : Integer, heightSegments : Integer) : BufferGeometry
        // (Constructor) ShadowMaterial( parameters : Object ) : Material
        const GROUND_MESH = new THREE.Mesh( new THREE.PlaneGeometry( 10, 10, 1, 1 ), new THREE.ShadowMaterial( { opacity: 0.25 } ) );
        // 메쉬를 90도 회전하여 X-Y 평면에서 X-Z 평면으로 하기
        // (Property) .geometry : BufferGeometry
        // (Method) .rotateX ( radians : Float ) : BufferGeometry
        GROUND_MESH.geometry.rotateX( -90 * Math.PI / 180 );
        // (Property) .receiveShadow : Boolean
        GROUND_MESH.receiveShadow = true;
        scene.add( GROUND_MESH );

        // 바닥에 그리드를 그리다
        // (Constructor) GridHelper( size : number, divisions : Number, colorCenterLine : Color, colorGrid : Color ) : Object3D -> Line
        scene.add( new THREE.GridHelper( 8, 20, 0x000000, 0x999999 ) );
        // X축(빨강), Y축(녹색), Z축(파랑) 그리기
        // (Constructor) AxesHelper( size : Number ) : Object3D -> Line -> LineSegments
        scene.add( new THREE.AxesHelper( 4 ) );
      }

      // (2) MMD 3D 모델 로드, 장면에 추가
      function loadMMD() {
        // 인스턴스 작성
        // (Constructor) MMDLoader( manager : LoadingManager ) : Loader
        const LOADER = new MMDLoader();
        // .pmd / .pmx 파일 가져오기
        // .load ( url : String, onLoad : Function, onProgress : Function, onError : Function ) : null
        LOADER.load (
          // 로드하는 PMD/PMX 파일
          '/storage/models/Alicia/MMD/Alicia_solid.pmx',
          // 로드 성공시의 처리
          function ( mmd ) {
            // MMD 3Dモデルのメッシュを作成
            mesh = mmd;
            for ( let i = 0; i < mesh.material.length; i ++ ) {
              // MMD 3D모델의 밝기를 조정한다
              // (Property) .emissive : Color
              // (Method) .multiplyScalar ( s : Number ) : Color
              mesh.material[ i ].emissive.multiplyScalar( 0.3 );
              // OutlineEffect의 윤곽선의 두께를 조정한다
              // (Property) .userData : Object
              mesh.material[ i ].userData.outlineParameters.thickness = 0.001;
            }
            // MMD 3D모델의 그림자를 그린다.
            // (Property) .castShadow : Boolean
            mesh.castShadow = true;
            // MMD 3D모델에 그림자를 그린다
            // (Property) .receiveShadow : Boolean
            mesh.receiveShadow = true;
            // 배율을 적용한다.
            // three.js 에서는、1단위는 1미터（1 unit = 1 meter）가 되기 때문에
            // ニコニ立体ちゃん(アリシア・ソリッド)의 경우、0.0739배 해서 신장148 cm에 상당하는 크기로 한다.
            // (Property) .scale : Vector3
            // (Method) .copy ( v : Vector3 ) : this
            mesh.scale.copy( new THREE.Vector3( 1, 1, 1 ).multiplyScalar( 0.0739 ) );
            // 모델 높이 정보를 얻기 위해 바운딩 상자를 작성
            // (Constructor) Box3( min : Vector3, max : Vector3 ) : Box3
            const BOUNDING_BOX = new THREE.Box3().setFromObject( mesh );
            // 카메라 위치 설정
            // (Property) .position : Vector3
            // (Method) .copy ( v : Vector3 ) : this
            // camera.position.copy( new THREE.Vector3( 0, 0.5 * BOUNDING_BOX.max.y, 4.5 ) );
            camera.position.copy( new THREE.Vector3( 0, 0.85 * BOUNDING_BOX.max.y, 1.25 ) );
            // 시점을 설정
            // (Property) .target : Vector3
            // controls.target = new THREE.Vector3( 0, 0.5 * BOUNDING_BOX.max.y, 0 );
            controls.target = new THREE.Vector3( 0, 0.85 * BOUNDING_BOX.max.y, 0 );
            // 스포트라이트 광원의 타겟의 위치를 설정
            // (Property) .target : Object3D
            // (Property) .position : Vector3
            // (Method) .copy ( v : Vector3 ) : this
            light.target.position.copy( new THREE.Vector3( 0, 0.5 * BOUNDING_BOX.max.y, 0 ) );
            // 메쉬를 장면(scene)에 추가
            // (Method) .add ( object : Object3D, ... ) : this
            scene.add( mesh );
          }
        );
      }

      // (3) 렌더링
      function sceneRender() {
        // (Constructor) window.requestAnimationFrame( callback )
        window.requestAnimationFrame( sceneRender );
        // OutlineEffect 적용
        // (Method) .render ( scene : Object3D, camera : Camera ) : null
        effect.render( scene, camera );
      }

      // 이벤트
      // 브라우저（윈도우）의 사이즈 변경시 처리
      window.addEventListener( 'resize', function () {
        // 반응형 대응
        // (Method) .setSize ( width : Integer, height : Integer, updateStyle : Boolean ) : null
        effect.setSize( parseInt( window.getComputedStyle( document.getElementById( 'webgl' ) ).width ), parseInt( window.getComputedStyle( document.getElementById( 'webgl' ) ).width ) * 540 / 960 );
      }, false );

      // '립싱크' 버튼을 클릭 했을 때 처리
      document.form1.button1.onclick = async function() {
        // textarea 에서 문자열을 얻는다.
        let input = String(document.form1.textarea1.value);

        // 「を」を「うぉ」として利用するため、「お」に置換
        input = input.replace( /を|ヲ/g, 'お' );
        // 置換しにくい言葉を前もって置換する
        input = input.replace( /(てぃ)|(でぃ)|(ティ)|(ディ)/g, 'い' );
        input = input.replace( /(でゅ)|(デュ)/g, 'う' );
        // 「とぅ」を「十(とぅ)」に置換
        input = input.replace( /(とぅ)|(トゥ)/g, '十' );
        // 「あ」行、「ま」行、「わ」行、「ん」「ー」の文字にに置換
        input = input.replace( /(うぁ)|(つぁ)|(ふぁ)|ワ|(ウァ)|(ツァ)|(ファ)/g, 'わ' );
        input = input.replace( /(うぃ)|(つぃ)|(ふぃ)|ヰ|(ウィ)|(ツィ)|(フィ)/g, 'ゐ' );
        input = input.replace( /(うぇ)|(つぇ)|(ふぇ)|ヱ|(ウェ)|(ツェ)|(フェ)/g, 'ゑ' );
        input = input.replace( /(うぉ)|(つぉ)|(ふぉ)|(ウォ)|(ツォ)(フォ)/g, 'を' );
        input = input.replace( /か|が|(きゃ)|(ぎゃ)|さ|ざ|(しゃ)|(じゃ)|た|だ|(ちゃ)|(ぢゃ)|な|(にゃ)|は|(ひゃ)|や|ら|(りゃ)/g, 'あ' );
        input = input.replace( /ア|カ|ガ|(キャ)|(ギャ)|サ|ザ|(シャ)|(ジャ)|タ|ダ|(チャ)|(ヂャ)|ナ|(ニャ)|ハ|(ヒャ)|ヤ|ラ|(リャ)/g, 'あ' );
        input = input.replace( /ば|(びゃ)|ぱ|(ぴゃ)|(ゔぁ)|マ|バ|(ビャ)|パ|(ピャ)|(ヴァ)/g, 'ま' );
        input = input.replace( /け|げ|せ|ぜ|(しぇ)|(じぇ)|て|で|(ちぇ)|(ぢぇ)|ね|へ|れ/g, 'え' );
        input = input.replace( /エ|ケ|ゲ|セ|ゼ|(シェ)|(ジェ)|テ|デ|(チェ)|(ヂェ)|ネ|ヘ|レ/g, 'え' );
        input = input.replace( /べ|ぺ|(ゔぇ)|メ|ベ|ペ|(ヴェ)/g, 'め' );
        input = input.replace( /こ|ご|(きょ)|(ぎょ)|そ|ぞ|(しょ)|(じょ)|と|ど|(ちょ)|(ぢょ)|の|(にょ)|ほ|(ひょ)|よ|ろ|(りょ)/g, 'お' );
        input = input.replace( /オ|コ|ゴ|(キョ)|(ギョ)|ソ|ゾ|(ショ)|(ジョ)|ト|ド|(チョ)|(ヂョ)|ノ|(ニョ)|ホ|(ヒョ)|ヨ|ロ|(リョ)/g, 'お' );
        input = input.replace( /ぼ|(びょ)|ぽ|(ぴょ)|モ|ボ|(ビョ)|ポ|(ピョ)/g, 'も' );
        input = input.replace( /ゔ|く|ぐ|(きゅ)|(ぎゅ)|す|ず|(しゅ)|(じゅ)|つ|づ|(ちゅ)|(ぢゅ)|ぬ|(にゅ)|ふ|(ひゅ)|ゆ|る|(りゅ)/g, 'う' );
        input = input.replace( /ウ|ヴ|ク|グ|(キュ)|(ギュ)|ス|ズ|(シュ)|(ジュ)|ツ|ヅ|(チュ)|(ヂュ)|ヌ|(ニュ)|フ|(ヒュ)|ユ|ル|(リュ)/g, 'う' );
        input = input.replace( /ぶ|(びゅ)|ぷ|(ぴゅ)|ム|ブ|(ビュ)|プ|(ピュ)/g, 'む' );
        input = input.replace( /き|ぎ|し|じ|ち|ぢ|に|ひ|り/g, 'い' );
        input = input.replace( /イ|キ|ギ|シ|ジ|チ|ヂ|ニ|ヒ|リ/g, 'い' );
        input = input.replace( /び|ぴ|ミ|ビ|ピ/g, 'み' );
        input = input.replace( /ン/g, 'ん' );
        input = input.replace( /っ|ッ/g, 'ー' );
        input = input.replace( /、|。|！|？/g, 'ーー' );
        input = input.replace( /「|」|（|）/g, '' );

         // 「ー」の置換。一つ前の文字によって置換する文字が変わる。
         for ( let i = 0; i < input.length; i ++ ) {
          if ( input.charAt( i ) === 'ー' ) {
            if ( input.charAt( i - 1 ).match( /あ|ま|わ/ ) ) {
              input = input.substring( 0, i ) + 'あ' + input.substring( i + 1, input.length );
            } else if ( input.charAt( i - 1 ).match( /い|み|ゐ/ ) ) {
              input = input.substring( 0, i ) + 'い' + input.substring( i + 1, input.length );
            } else if ( input.charAt( i - 1 ).match( /う|む|十/ ) ) {
              input = input.substring( 0, i ) + 'う' + input.substring( i + 1, input.length );
            } else if ( input.charAt( i - 1 ).match( /え|め|ゑ/ ) ) {
              input = input.substring( 0, i ) + 'え' + input.substring( i + 1, input.length );
            } else if ( input.charAt( i - 1 ).match( /お|も|を/ ) ) {
              input = input.substring( 0, i ) + 'お' + input.substring( i + 1, input.length );
            } else if ( input.charAt( i - 1 ).match( /ん/ ) ) {
              input = input.substring( 0, i ) + 'ん' + input.substring( i + 1, input.length );
            }
            
          }
        }

         // 一文字ずつ表情のアニメーションを実行
         for ( let i = 0; i < input.length; i ++ ) {
          if ( input.charAt( i ).match( /あ|い|う|え|お|ん/ ) ) {
            await morphAnimation( input.charAt( i ), input.charAt( i + 1 ), frameNumber, morphValue );
          } else if ( input.charAt( i ) === 'ま' ) {
            // 「ま」行は、口を一度閉じる
            await morphAnimation( 'あ', 'あ', 1, 0 );
            await morphAnimation( 'あ', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'み' ) {
            await morphAnimation( 'い', 'い', 1, 0 );
            await morphAnimation( 'い', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'む' ) {
            await morphAnimation( 'う', 'う', 1, 0 );
            await morphAnimation( 'う', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'め' ) {
            await morphAnimation( 'え', 'え', 1, 0 );
            await morphAnimation( 'え', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'も' ) {
            await morphAnimation( 'お', 'お', 1, 0 );
            await morphAnimation( 'お', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'わ' ) {
            // 「わ」行は、まず口を「う」の形にする
            await morphAnimation( 'う', 'あ', 1, morphValue );
            await morphAnimation( 'あ', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'ゐ' ) {
            await morphAnimation( 'う', 'い', 1, morphValue );
            await morphAnimation( 'い', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'ゑ' ) {
            await morphAnimation( 'う', 'え', 1, morphValue );
            await morphAnimation( 'え', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === 'を' ) {
            await morphAnimation( 'う', 'お', 1, morphValue );
            await morphAnimation( 'お', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          } else if ( input.charAt( i ) === '十' ) {
            // 「十」は、まず口を「お」の形にした後、「う」の形にする
            await morphAnimation( 'お', 'う', 1, morphValue );
            await morphAnimation( 'う', input.charAt( i + 1 ), frameNumber - 1, morphValue );
          }
        }
      };

      // ライブラリー
      // 表情（モーフ）のアニメーション
      function morphAnimation( morphName, nextMorphName, frame = 4, value = 1 ) {
        // 非同期処理のためのPromise関数
        return new Promise( function ( resolve ) {
          // アニメーションの間隔、24 FPSとなるように間隔を設定
          const INTERVAL = 1000 / frameRate;
          // .morphTargetDictionaryを使用して表情（モーフ）のインデックスを取得
          const INDEX = mesh.morphTargetDictionary[ morphName ];
          // 開始時に開始時点の表情（モーフ）の値を設定
          mesh.morphTargetInfluences[ INDEX ] = value;
          // frameで指定した時間待機
          setTimeout( function() {
            // resolve()により非同期処理が完了
            resolve();
            // resolve()後、1つ後の文字によって対応が変わる
            if ( morphName === nextMorphName ) {
              // 現在の口の形を維持する
              return;
            } else if ( morphName !== nextMorphName && nextMorphName.match( /ま|み|む|め|も/ ) ) {
              // 口を閉じる
              mesh.morphTargetInfluences[ INDEX ] = 0;
            } else if ( morphName !== nextMorphName && nextMorphName.match( /わ|ゐ|ゑ|を/ ) ) {
              // 口を「う」の形にする
              mesh.morphTargetInfluences[ INDEX ] = 0;
              mesh.morphTargetInfluences[ mesh.morphTargetDictionary[ 'う' ] ] = value;
            } else if ( morphName !== nextMorphName && nextMorphName === '十' ) {
              // 口を「お」の形にする
              mesh.morphTargetInfluences[ INDEX ] = 0;
              mesh.morphTargetInfluences[ mesh.morphTargetDictionary[ 'お' ] ] = value;
            } else {
              // 1フレーム後に表情（モーフ）の値を0にする
              setTimeout( function() {
                mesh.morphTargetInfluences[ INDEX ] = 0;
              }, INTERVAL );
            }
          }, INTERVAL * frame );
        } );
      }
		</script>
	</body>
</html>