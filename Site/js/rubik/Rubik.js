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
// Constructeur
function Rubik(taille) {
	this.taille = taille;

	this.left = new Array(new Array());
	this.right = new Array(new Array());
	this.up = new Array(new Array());
	this.down = new Array(new Array());
	this.front = new Array(new Array());
	this.back = new Array(new Array());
	this.init();
}

// Initialise toutes les variables
Rubik.prototype.init = function() {
	leftcp = new Array();
	rightcp = new Array();
	upcp = new Array();
	downcp = new Array();
	frontcp = new Array();
	backcp = new Array();
	for (var x = 0; x < this.taille; x++) {
		pleft = new Array();
		pright = new Array();
		pup = new Array();
		pdown = new Array();
		pfront = new Array();
		pback = new Array();
		for (var y = 0; y < this.taille; y++) {
			pleft.push(BLUE);
			pright.push(GREEN);
			pup.push(WHITE);
			pdown.push(YELLOW);
			pfront.push(RED);
			pback.push(ORANGE);
		}
		leftcp.push(pleft);
		rightcp.push(pright);
		upcp.push(pup);
		downcp.push(pdown);
		frontcp.push(pfront);
		backcp.push(pback);
	}
	this.left = leftcp;
	this.right = rightcp;
	this.up = upcp;
	this.down = downcp;
	this.front = frontcp;
	this.back = backcp;
}

// Fonction copie
Rubik.prototype.cp = function(leftCP, rightCP, upCP, downCP, frontCP, backCP) {
	leftcpCP = new Array();
	rightcpCP = new Array();
	upcpCP = new Array();
	downcpCP = new Array();
	frontcpCP = new Array();
	backcpCP = new Array();
	for (var x = 0; x < this.taille; x++) {
		pleftCP = new Array();
		prightCP = new Array();
		pupCP = new Array();
		pdownCP = new Array();
		pfrontCP = new Array();
		pbackCP = new Array();
		for (var y = 0; y < this.taille; y++) {
			pleftCP.push(this.left[x][y]);
			prightCP.push(this.right[x][y]);
			pupCP.push(this.up[x][y]);
			pdownCP.push(this.down[x][y]);
			pfrontCP.push(this.front[x][y]);
			pbackCP.push(this.back[x][y]);
		}
		leftcpCP.push(pleftCP);
		rightcpCP.push(prightCP);
		upcpCP.push(pupCP);
		downcpCP.push(pdownCP);
		frontcpCP.push(pfrontCP);
		backcpCP.push(pbackCP);
	}
	leftCP = leftcpCP;
	rightCP = rightcpCP;
	upCP = upcpCP;
	downCP = downcpCP;
	frontCP = frontcpCP;
	backCP = backcpCP;
	return [ leftCP, rightCP, upCP, downCP, frontCP, backCP ];
}

/**
 * Procedure qui permet de mouvoir une couronne selon l'axe X
 * 
 * @param int
 *            pos : la position de la courone
 * @param int
 *            sens : le sens dans lequel tourne la face horaire ou anti-horaire
 *            modifie les faces correspondantes
 */
Rubik.prototype.X = function(pos, sens) {
	var leftCP = new Array(new Array());
	var rightCP = new Array(new Array());
	var upCP = new Array(new Array());
	var downCP = new Array(new Array());
	var frontCP = new Array(new Array());
	var backCP = new Array(new Array());

	var tmp = this.cp(leftCP, rightCP, upCP, downCP, frontCP, backCP);
	leftCP = tmp[0];
	rightCP = tmp[1];
	upCP = tmp[2];
	downCP = tmp[3];
	frontCP = tmp[4];
	backCP = tmp[5];

	if (pos == 0) {
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == 1) {
					this.right[x][y] = rightCP[y][this.taille - 1 - x];
				} else {
					this.right[x][y] = rightCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	if (pos == this.taille - 1) {
		console.log(this.left[0][0]);
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == 1) {
					this.left[x][y] = leftCP[y][this.taille - 1 - x];
				} else {
					this.left[x][y] = leftCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	for (var y = 0; y < this.taille; y++) {
		if (sens == 1) {
			this.front[pos][y] = upCP[pos][this.taille - 1 - y];
			this.up[pos][y] = backCP[pos][y];
			this.back[pos][y] = downCP[pos][this.taille - 1 - y];
			this.down[pos][y] = frontCP[pos][y];
		} else {
			this.front[pos][y] = downCP[pos][y];
			this.up[pos][y] = frontCP[pos][this.taille - 1 - y];
			this.back[pos][y] = upCP[pos][y];
			this.down[pos][y] = backCP[pos][this.taille - 1 - y];
		}
	}
}

// Fonction Y
Rubik.prototype.Y = function(pos, sens) {
	var leftCP = new Array(new Array());
	var rightCP = new Array(new Array());
	var upCP = new Array(new Array());
	var downCP = new Array(new Array());
	var frontCP = new Array(new Array());
	var backCP = new Array(new Array());

	var tmp = this.cp(leftCP, rightCP, upCP, downCP, frontCP, backCP);
	leftCP = tmp[0];
	rightCP = tmp[1];
	upCP = tmp[2];
	downCP = tmp[3];
	frontCP = tmp[4];
	backCP = tmp[5];

	if (pos == 0) {
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == -1) {
					this.down[x][y] = downCP[y][this.taille - 1 - x];
				} else {
					this.down[x][y] = downCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	if (pos == this.taille - 1) {
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == -1) {
					this.up[x][y] = upCP[y][this.taille - 1 - x];
				} else {
					this.up[x][y] = upCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	for (var y = 0; y <= this.taille - 1; y++) {
		if (sens == 1) {
			this.front[y][pos] = rightCP[pos][y];
			this.right[pos][y] = backCP[this.taille - 1 - y][pos];
			this.back[y][pos] = leftCP[pos][y];
			this.left[pos][y] = frontCP[this.taille - 1 - y][pos];
		} else {
			this.front[y][pos] = leftCP[pos][this.taille - 1 - y];
			this.left[pos][y] = backCP[y][pos];
			this.back[y][pos] = rightCP[pos][this.taille - 1 - y];
			this.right[pos][y] = frontCP[y][pos];
		}
	}
}

// Fonction Z

Rubik.prototype.Z = function(pos, sens) {
	var leftCP = new Array(new Array());
	var rightCP = new Array(new Array());
	var upCP = new Array(new Array());
	var downCP = new Array(new Array());
	var frontCP = new Array(new Array());
	var backCP = new Array(new Array());

	var tmp = this.cp(leftCP, rightCP, upCP, downCP, frontCP, backCP);
	leftCP = tmp[0];
	rightCP = tmp[1];
	upCP = tmp[2];
	downCP = tmp[3];
	frontCP = tmp[4];
	backCP = tmp[5];

	if (pos == 0) {
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == 1) {
					this.back[x][y] = backCP[y][this.taille - 1 - x];
				} else {
					this.back[x][y] = backCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	if (pos == this.taille - 1) {
		for (var x = 0; x < this.taille; x++) {
			for (var y = 0; y < this.taille; y++) {
				if (sens == 1) {
					this.front[x][y] = frontCP[y][this.taille - 1 - x];
				} else {
					this.front[x][y] = frontCP[this.taille - 1 - y][x];
				}
			}
		}
	}
	for (var y = 0; y < this.taille; y++) {
		if (sens == 1) {
			this.up[y][pos] = leftCP[this.taille - 1 - y][pos];
			this.left[y][pos] = downCP[y][pos];
			this.down[y][pos] = rightCP[this.taille - 1 - y][pos];
			this.right[y][pos] = upCP[y][pos];
		} else {
			this.up[y][pos] = rightCP[y][pos];
			this.right[y][pos] = downCP[this.taille - 1 - y][pos];
			this.down[y][pos] = leftCP[y][pos];
			this.left[y][pos] = upCP[this.taille - 1 - y][pos];
		}
	}
}

// Melange le rubik's cube de facon aléatoire
Rubik.prototype.melanger = function() {
	for (var y = 0; y < 50; y++) {
		pos = parseInt(Math.random() * (this.taille - 1));
		switch (parseInt(Math.random() * 6)) {
		case 0:
			this.X(pos, 1);
			break;
		case 1:
			this.Y(pos, 1);
			break;
		case 2:
			this.Z(pos, 1);
			break;
		case 3:
			this.X(pos, -1);
			break;
		case 4:
			this.Y(pos, -1);
			break;
		case 5:
			this.Z(pos, -1);
			break;
		default:
			break;
		}
	}
}

Rubik3D.prototype.remove = function(scene) {
	scene.remove(this.cube3D);
}