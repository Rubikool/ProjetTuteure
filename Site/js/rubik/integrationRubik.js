/**
 * 
 */
var rubik;
var scene;
var camera;
var renderer;
var controls;
var axes = true;
var cubeMeshX;
var cubeMeshY;
var cubeMeshZ;
var targetList;

window.onload = function() {
	var taille = document.getElementById("taille").value;
	rubik = new Rubik3D(taille);
	init();
	animate();
};

function init() {
	var aLight = new THREE.AmbientLight(0xaaaaaa);

	scene = new THREE.Scene();
	renderer = new THREE.WebGLRenderer();
	camera = new THREE.PerspectiveCamera(75, window.innerWidth
			/ window.innerHeight, 1, 5000);

	camera.position.set(500, 500, 500);
	camera.rotation.set(0, 0, 0);
	camera.up = new THREE.Vector3(0, 1, 0);
	camera.lookAt(new THREE.Vector3(0, 0, 0));

	renderer.setSize(window.innerWidth / 2, window.innerHeight / 2);
	renderer.shadowMapType = THREE.PCFSoftShadowMap;
	renderer.setClearColor(0xffffff);

	controls = new THREE.OrbitControls(camera, renderer.domElement);
	controls.enableDamping = false;
	controls.dampingFactor = 0.25;
	controls.enableZoom = true;

	creeAxes();

	scene.add(aLight);


	document.getElementById("container").appendChild(renderer.domElement);
	document.addEventListener('mousedown', onDocumentMouseDown, false);
}

function recentrer() {
	camera.position.set(500, 500, 1000); // pos de la camera
	camera.rotation.set(0, 0, 0);
	camera.up = new THREE.Vector3(0, 1, 0);
	camera.lookAt(new THREE.Vector3(0, 0, 0));
}

function animate() {
	requestAnimationFrame(animate);
	render();
}

function render() {
	renderer.render(scene, camera);
	rubik.render(scene, targetList);
}

function onDocumentMouseDown(event) {

	mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
	mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

	var vector = new THREE.Vector3(mouse.x, mouse.y, 1);
	projector.unprojectVector(vector, camera);
	var ray = new THREE.Raycaster(camera.position, vector.sub(camera.position)
			.normalize());

	var intersects = ray.intersectObjects(targetList);
	console.log(intersects.lenght);

	// if there is one (or more) intersections
	if (intersects.length > 0) {
		console.log("Hit @ ");
		// change the color of the closest face.
		// intersects[0].face.color.setRGB(0.8 * Math.random() + 0.2, 0.8 * Math
		// .random() + 0.2, 0.8 * Math.random() + 0.2);
		// intersects[0].object.geometry.colorsNeedUpdate = true;
	}

}

function creeAxes() {
	if (axes) {
		var cubeGeoX = new THREE.CubeGeometry(10000, 3, 3);
		var cubeMatX = new THREE.MeshLambertMaterial({
			color : 0x880000
		});
		cubeMeshX = new THREE.Mesh(cubeGeoX, cubeMatX);
		cubeMeshX.position.set(0, 0, 0);
		scene.add(cubeMeshX);

		var cubeGeoY = new THREE.CubeGeometry(3, 10000, 3);
		var cubeMatY = new THREE.MeshLambertMaterial({
			color : 0x008800
		});
		cubeMeshY = new THREE.Mesh(cubeGeoY, cubeMatY);
		cubeMeshY.position.set(0, 0, 0);
		scene.add(cubeMeshY);

		var cubeGeoZ = new THREE.CubeGeometry(3, 3, 10000);
		var cubeMatZ = new THREE.MeshLambertMaterial({
			color : 0x000088
		});
		cubeMeshZ = new THREE.Mesh(cubeGeoZ, cubeMatZ);
		cubeMeshZ.position.set(0, 0, 0);
		scene.add(cubeMeshZ);
	} else {
		scene.remove(cubeMeshX);
		scene.remove(cubeMeshY);
		scene.remove(cubeMeshZ);
	}
	axes = !axes;
}

function melanger() {
	rubik.melanger();
}

function X(pos, sens) {
	rubik.X(pos, sens);
}

function Y(pos, sens) {
	rubik.Y(pos, sens);
}

function Z(pos, sens) {
	rubik.Z(pos, sens);
}