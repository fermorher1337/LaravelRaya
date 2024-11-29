<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>4 en raya</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
    <div>
        <h1>4 en Raya</h1>
        <div id="tablero"></div>
        <button onclick="iniciarJuego()">Iniciar Juego</button>
        
       
        <button onclick="verHistorial()">Historial</button>

        <p id="mensaje"></p>

        
        <div class="modal" id="nameModal">
            <div class="modal-content">
                <h3>¡Felicidades!</h3>
                <p>Ingresa tu nombre:</p>
                <input type="text" id="nombreInput" placeholder="Tu nombre" />
                <button onclick="guardarNombre()">Guardar</button>
            </div>
        </div>
    </div>

    <script>
        let turno = 'rojo'; 
        let tablero = Array(6).fill().map(() => Array(7).fill(null)); // 6x7 
        const tableroElemento = document.getElementById('tablero');
        const mensajeElemento = document.getElementById('mensaje');
        const nameModal = document.getElementById('nameModal');
        const nombreInput = document.getElementById('nombreInput');

        function iniciarJuego() {
            
            tablero = Array(6).fill().map(() => Array(7).fill(null));
            tableroElemento.innerHTML = '';
            mensajeElemento.innerText = '';

            
            for (let fila = 0; fila < 6; fila++) {
                for (let columna = 0; columna < 7; columna++) {
                    const celda = document.createElement('div');
                    celda.classList.add('celda');
                    celda.dataset.fila = fila;
                    celda.dataset.columna = columna;
                    celda.onclick = () => hacerMovimiento(fila, columna);
                    tableroElemento.appendChild(celda);
                }
            }
        }

        function hacerMovimiento(fila, columna) {
 
            for (let i = 5; i >= 0; i--) {
                if (!tablero[i][columna]) {
                    tablero[i][columna] = turno;
                    actualizarTablero();
                    if (verificarGanador(i, columna)) {
                        mensajeElemento.innerText = `¡${turno.charAt(0).toUpperCase() + turno.slice(1)} ha ganado!`;
                        mostrarModal();  
                    }
                    turno = turno === 'rojo' ? 'amarillo' : 'rojo';
                    break;
                }
            }
        }

        function actualizarTablero() {
            let celdas = document.querySelectorAll('.celda');
            for (let i = 0; i < 6; i++) {
                for (let j = 0; j < 7; j++) {
                    let celda = celdas[i * 7 + j];
                    if (tablero[i][j] === 'rojo') {
                        celda.classList.add('rojo');
                        celda.classList.remove('amarillo');
                    } else if (tablero[i][j] === 'amarillo') {
                        celda.classList.add('amarillo');
                        celda.classList.remove('rojo');
                    } else {
                        celda.classList.remove('rojo', 'amarillo');
                    }
                }
            }
        }

        function verificarGanador(fila, columna) {
            return verificarLinea(fila, columna, 1, 0) || // Horizontal
                   verificarLinea(fila, columna, 0, 1) || // Vertical
                   verificarLinea(fila, columna, 1, 1) || // Diagonal /
                   verificarLinea(fila, columna, 1, -1);  // Diagonal \
        }

        function verificarLinea(fila, columna, direccionFila, direccionColumna) {
            let cuenta = 1; 
            for (let i = 1; i < 4; i++) {
                const nuevaFila = fila + i * direccionFila;
                const nuevaColumna = columna + i * direccionColumna;
                if (nuevaFila >= 0 && nuevaFila < 6 && nuevaColumna >= 0 && nuevaColumna < 7 && tablero[nuevaFila][nuevaColumna] === turno) {
                    cuenta++;
                } else {
                    break;
                }
            }

            for (let i = 1; i < 4; i++) {
                const nuevaFila = fila - i * direccionFila;
                const nuevaColumna = columna - i * direccionColumna;
                if (nuevaFila >= 0 && nuevaFila < 6 && nuevaColumna >= 0 && nuevaColumna < 7 && tablero[nuevaFila][nuevaColumna] === turno) {
                    cuenta++;
                } else {
                    break;
                }
            }

            return cuenta >= 4;
        }

        function mostrarModal() {
            nameModal.style.display = 'flex';
        }

        function guardarNombre() {
            const nombre = nombreInput.value;
            if (nombre.trim() !== '') {
                guardarResultado(nombre);
                nameModal.style.display = 'none'; 
            } else {
                alert('Por favor ingresa tu nombre.');
            }
        }

        function guardarResultado(nombre) {
            fetch('/juego/guardar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    nombre: nombre
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => console.error('Error:', error));
        }

       
        function verHistorial() {
            window.location.href = '/historial';
        }
    </script>
</body>
</html>