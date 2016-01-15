/**
 * 
 */
var BLACK = 0;
var BLUE = 1;
var GREEN = 2;
var WHITE = 3;
var YELLOW = 4;
var RED = 5;
var ORANGE = 6;
var GREY = 7;

var TAILLE_CUBE = 145;
var ESPACEMENT = 5;

var CUBE_GEOMETRY = new THREE.CubeGeometry(TAILLE_CUBE, TAILLE_CUBE,
		TAILLE_CUBE);

var MATERIAUX = [ new THREE.MeshPhongMaterial({
	color : 0x101010
}), new THREE.MeshPhongMaterial({
	color : 'blue'
}), new THREE.MeshPhongMaterial({
	color : 'green'
}), new THREE.MeshPhongMaterial({
	color : 'white'
}), new THREE.MeshPhongMaterial({
	color : 'yellow'
}), new THREE.MeshPhongMaterial({
	color : 'red'
}), new THREE.MeshPhongMaterial({
	color : 0xFF8800
}), new THREE.MeshPhongMaterial({
	color : 0x888888
}) ]

// Constructeur
function Rubik3D(taille) {
	this.taille = taille;
	this.rubik3D = new Array(new Array(new Array()));
	this.rubik = new Rubik(taille);
	this.cube3D = new THREE.Object3D();

	this.vitesseX = 0;
	this.vitesseY = 0;
	this.vitesseZ = 0;
	this.varX = -1;
	this.varY = -1;
	this.varZ = -1;
	this.enCours = 0;
}

Rubik3D.prototype.init = function() {
	this.rubik.init();
}

// affiche le cube dans une scene donnée
Rubik3D.prototype.afficher = function(scene, targetList) {
	targetList = new Array();
	var mid = (this.taille - 1) / 2;
	// TODO: faire générique
	this.cube3D = new THREE.Object3D();
	px = new Array();
	for (var x = -mid; x <= mid; x++) {
		py = new Array();
		for (var y = -mid; y <= mid; y++) {
			pz = new Array();
			for (var z = -mid; z <= mid; z++) {
				// Init les cote du cube de la couleur BLACK
				materials = [ BLACK, BLACK, BLACK, BLACK, BLACK, BLACK ];
				// vérifie les couleurs effectivent en fonction de leur position
				// sur le cube. Les creer en couleur utilisable pour
				// l'affichage3D simultanement
				// TODO: WARNING: +1 et -1 !!!
				if (x == mid)
					materials[0] = MATERIAUX[this.rubik.left[y + mid][z + mid]];
				else
					materials[0] = MATERIAUX[BLACK];
				if (x == -mid)
					materials[1] = MATERIAUX[this.rubik.right[y + mid][z + mid]];
				else
					materials[1] = MATERIAUX[BLACK];
				if (y == mid)
					materials[2] = MATERIAUX[this.rubik.up[x + mid][z + mid]];
				else
					materials[2] = MATERIAUX[BLACK];
				if (y == -mid)
					materials[3] = MATERIAUX[this.rubik.down[x + mid][z + mid]];
				else
					materials[3] = MATERIAUX[BLACK];
				if (z == mid)
					materials[4] = MATERIAUX[this.rubik.front[x + mid][y + mid]];
				else
					materials[4] = MATERIAUX[BLACK];
				if (z == -mid)
					materials[5] = MATERIAUX[this.rubik.back[x + mid][y + mid]];
				else
					materials[5] = MATERIAUX[BLACK];
				// Creer le cube
				cube = new THREE.Mesh(CUBE_GEOMETRY,
						new THREE.MeshFaceMaterial(materials));
				cube.position.set(x * (TAILLE_CUBE + ESPACEMENT), y
						* (TAILLE_CUBE + ESPACEMENT), z
						* (TAILLE_CUBE + ESPACEMENT));
				scene.add(cube);
				targetList.push(cube);
				pivotPoint = new THREE.Object3D();
				this.cube3D.add(pivotPoint);
				pivotPoint.add(cube);
				pz.push(pivotPoint);
			}
			py.push(pz);
		}
		px.push(py);
	}
	this.rubik3D = px;
	scene.add(this.cube3D);
}

Rubik3D.prototype.X = function(pos, sens) {
	if (this.enCours == 0) {
		this.vitesseX = sens * Math.PI / 90;
		this.varX = pos;
		this.varY = -1;
		this.varZ = -1;
		this.enCours = 45;
		this.rubik.X(pos, sens);
	}
}

Rubik3D.prototype.Y = function(pos, sens) {
	if (this.enCours == 0) {
		this.vitesseY = sens * Math.PI / 90;
		this.varY = pos;
		this.varX = -1;
		this.varZ = -1;
		this.enCours = 45;
		this.rubik.Y(pos, sens);
	}
}

Rubik3D.prototype.Z = function(pos, sens) {
	if (this.enCours == 0) {
		this.vitesseZ = sens * Math.PI / 90;
		this.varZ = pos;
		this.varX = -1;
		this.varY = -1;
		this.enCours = 45;
		this.rubik.Z(pos, sens);
	}
}

Rubik3D.prototype.render = function(scene, targetList) {
	if (this.enCours == 0) {
		scene.remove(this.cube3D);
		this.afficher(scene, targetList);

		this.vitesseX = 0;
		this.vitesseY = 0;
		this.vitesseZ = 0;
		this.varX = -1;
		this.varY = -1;
		this.varZ = -1;
	}
	if (this.enCours > 0) {
		this.enCours--;
	}
	for (var x = 0; x < this.taille; x++) {
		for (var y = 0; y < this.taille; y++) {
			for (var z = 0; z < this.taille; z++) {
				if (x == this.varX) {
					this.rubik3D[x][y][z].rotation.x += this.vitesseX;
				}
				if (y == this.varY) {
					this.rubik3D[x][y][z].rotation.y += this.vitesseY;
				}
				if (z == this.varZ) {
					this.rubik3D[x][y][z].rotation.z += this.vitesseZ;
				}
			}
		}
	}
}

Rubik3D.prototype.melanger = function() {
	this.rubik.melanger();
}
