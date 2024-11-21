document.addEventListener('DOMContentLoaded', function() {
    let productos = [];
    const productosContainer = document.getElementById('productos-container');
    const buscador = document.getElementById('buscador-productos');

    // Obtener productos desde el backend
    fetch('obtener_productos.php')
        .then(response => response.json())
        .then(data => {
            productos = data;
            mostrarProductos(productos);
        })
        .catch(error => console.error('Error al obtener productos:', error));

    // Función para mostrar productos en la página
    function mostrarProductos(productosFiltrados) {
        productosContainer.innerHTML = ''; // Limpiar el contenedor

        productosFiltrados.forEach(producto => {
            let div = document.createElement('div');
            div.classList.add('producto');
            
            let img = document.createElement('img');
            img.src = producto.imagen; // URL de la imagen
            img.alt = producto.nombre;
            img.classList.add('producto-imagen');

            let h3 = document.createElement('h3');
            h3.textContent = producto.nombre;

            let p = document.createElement('p');
            p.textContent = `Precio: $${producto.precio}`;

            let descripcion = document.createElement('p');
            descripcion.textContent = producto.descripcion;

            div.appendChild(img);
            div.appendChild(h3);
            div.appendChild(p);
            div.appendChild(descripcion);
            productosContainer.appendChild(div);
        });
    }

    // Filtrar productos cuando el usuario escribe en el buscador
    buscador.addEventListener('input', function() {
        const textoBusqueda = buscador.value.toLowerCase();

        const productosFiltrados = productos.filter(producto => 
            producto.nombre.toLowerCase().includes(textoBusqueda) ||
            producto.descripcion.toLowerCase().includes(textoBusqueda)
        );

        mostrarProductos(productosFiltrados);
    });
});
