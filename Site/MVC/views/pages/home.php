<?php
//Include the experimental html tag functions
include($_SERVER['DOCUMENT_ROOT'].'/../PHPIncludes/Libraries/HTMLTagExperimental.php');

echo '<body>';

include($_SERVER['DOCUMENT_ROOT'].'/../PHPIncludes/Views/pages/home/INC_TopPageGreeting.php');





?>

 

<!-- RYANS CODE -->		
	//Voice feedback
	<script src='https://code.responsivevoice.org/responsivevoice.js'></script>

	//3D environment scripts:
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/build/three.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/controls/OrbitControls.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/loaders/collada/Animation.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/loaders/collada/AnimationHandler.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/loaders/collada/KeyFrameAnimation.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/loaders/ColladaLoader.js"></script>
	<script src="https://cdn.webaddressgoeshere.com/Ryan3DJSScripts/three.js-master/examples/js/Detector.js"></script>
	


		<script type="x-shader/x-vertex" id="vertexShader">
			varying vec3 vWorldPosition;
			void main() {
				vec4 worldPosition = modelMatrix * vec4( position, 1.0 );
				vWorldPosition = worldPosition.xyz;
				gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
			}
		</script>


		<script type="x-shader/x-fragment" id="fragmentShader">
			uniform vec3 topColor;
			uniform vec3 bottomColor;
			uniform float offset;
			uniform float exponent;
			varying vec3 vWorldPosition;
			void main() {
				float h = normalize( vWorldPosition + offset ).y;
				gl_FragColor = vec4( mix( bottomColor, topColor, max( pow( max( h , 0.0), exponent ), 0.0 ) ), 1.0 );
			}
		</script>


		<script>
			
			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var container;
			var camera, scene, renderer, objects;

			//Var particleLight;
			var dae;
			var animation;
			
			var loader = new THREE.ColladaLoader();
			loader.options.convertUpAxis = true;
			loader.load( 'https://cdn.webaddressgoeshere.com/Content/Ryan3DResources/adam.dae', function ( collada ) {

				dae = collada.scene;

				dae.traverse( function ( child ) {

					if ( child instanceof THREE.SkinnedMesh ) {

						animation = new THREE.Animation( child, child.geometry.animation );
						animation.play(0);

					}

				} );

				dae.scale.x = dae.scale.y = dae.scale.z = 1;
				dae.updateMatrix();

				init();
				animate();

			} );

			function init() {
				responsiveVoice.setDefaultVoice("UK English Male");
				container = document.createElement( 'div' );
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 2000 );
				camera.position.set( 2, 2, 3 );

				scene = new THREE.Scene();

				scene.fog = new THREE.Fog( 0xffffff, 1000, 500000 );
				scene.fog.color.setHSL( 0.6, 0, 1 );

				//Add the COLLADA
				scene.add( dae );


				//Lights
				scene.add( new THREE.AmbientLight( 0xcccccc ) );

				var directionalLight = new THREE.DirectionalLight(/*Math.random() * 0xffffff*/0xeeeeee );
				directionalLight.position.x = Math.random() - 0.5;
				directionalLight.position.y = Math.random() - 0.5;
				directionalLight.position.z = Math.random() - 0.5;
				directionalLight.position.normalize();
				scene.add( directionalLight );


				
				renderer = new THREE.WebGLRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				renderer.setClearColor( scene.fog.color );
				renderer.shadowMapEnabled = true;
				renderer.shadowMapSoft = true;
				renderer.shadowMapType = THREE.PCFShadowMap;
				renderer.shadowMapAutoUpdate = true;
				renderer.gammaInput = true;
				renderer.gammaOutput = true;
				container.appendChild( renderer.domElement );
				var groundGeo = new THREE.PlaneBufferGeometry( 10000, 10000 );
				var groundMat = new THREE.MeshPhongMaterial( { color: 0xffffff, specular: 0x050505 } );
				groundMat.color.setHSL( 0.095, 1, 0.75 );
				var ground = new THREE.Mesh( groundGeo, groundMat );
				ground.rotation.x = -Math.PI/2;
				ground.position.y = -10;
				scene.add( ground );
				ground.receiveShadow = true;
				
				
				//

				var onDocumentMouseDown = function ( event ) {

	           			

				};
				
				document.addEventListener('mousedown',onDocumentMouseDown,false);
				
				
				
				window.addEventListener( 'resize', onWindowResize, false );

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

			var clock = new THREE.Clock();

			
			var currentSequence = 'bobing';
			

			function render() {				
				
				var timer = Date.now() * 0.0005;

				camera.position.x = Math.cos( timer ) * 10;
				camera.position.y = 2;
				camera.position.z = Math.sin( timer ) * 10;

				camera.lookAt( scene.position );


				THREE.AnimationHandler.update( clock.getDelta() );

				if(responsiveVoice.isPlaying()) {
					currentSequence = 'talking';
				}else{
					currentSequence = 'bobing';
				}
				console.log(animation.currentTime);
				
				
				if (currentSequence == 'bobing') {
					if (animation.currentTime > 0.2) {
						animation.stop();
						animation.play(0); // play the animation not looped, from 0s
					}
					dae.position.y = Math.sin( timer * 4 ) * 0.1  ;
				} else if (currentSequence == 'talking') {
					if (animation.currentTime <= 0.2 || animation.currentTime > 1 ){
						animation.stop();
						console.log("ran");
						animation.play(0.2); // play the animation not looped, from 4s
					}
					dae.position.y = Math.sin( timer * 6 )  ;
				}
				renderer.render( scene, camera );

			}
		</script>

		<!-- END RYANS CODE -->



<br><br>
<p>The press on the head to speak</p>
<div id="transcript">
</div>