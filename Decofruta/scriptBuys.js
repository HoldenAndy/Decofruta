const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');
const formularioPago = document.getElementById('formulario-pago');

const mensajeFlotante = document.getElementById('mensaje-flotante');
const textoMensaje = document.getElementById('texto-mensaje');
const botonAceptar = document.getElementById('boton-aceptar');


btnCart.addEventListener('click', () => {
  containerCartProducts.classList.toggle('hidden-cart');
});

document.addEventListener('DOMContentLoaded', () => {
  const opcionEntrega = document.getElementById('opcion-entrega');
  const camposRecojo = document.getElementById('campos-recojo');
  const camposDespacho = document.getElementById('campos-despacho');
  const btnPagar = document.getElementById('btn-pay');
  const formularioPagoContainer = document.getElementById('formulario-pago-container');
  const btnContinuar = document.getElementById('btn-continuar');
  const btnCancelar = document.getElementById('btn-cancelar');
  const productosSeleccionados = document.getElementById('productos-seleccionados');
  const totalPagarElement = document.getElementById('precio-total');
  const metodoPagoTarjeta = document.getElementById('metodo-pago-tarjeta');
  const btnFinalizarCompra = document.getElementById('btn-finalizar-compra');
  const btnCancelarPago = document.getElementById('btn-cerrar-tarjeta');

  opcionEntrega.addEventListener('change', () => {
    if (opcionEntrega.value === 'recojo') {
      camposRecojo.classList.remove('hidden');
      camposDespacho.classList.add('hidden');
    } else if (opcionEntrega.value === 'despacho') {
      camposRecojo.classList.add('hidden');
      camposDespacho.classList.remove('hidden');
    }
  });

  btnPagar.addEventListener('click', () => {
    formularioPagoContainer.classList.remove('hidden');
    containerCartProducts.classList.add('hidden-cart');
    actualizarProductosSeleccionados();
  });

  btnContinuar.addEventListener('click', () => {
    metodoPagoTarjeta.classList.remove('hidden');
  });

  btnCancelar.addEventListener('click', () => {
    formularioPagoContainer.classList.add('hidden');
  });

  const actualizarProductosSeleccionados = () => {
    productosSeleccionados.innerHTML = '';
    let totalPagar = 0;

    allProducts.forEach(product => {
      const productItem = document.createElement('div');
      productItem.classList.add('producto-item');
      const subtotal = product.quantity * parseInt(product.price.slice(2));
      totalPagar += subtotal;

      productItem.innerHTML = `
        <div class="producto-info">
          <p>${product.quantity} x ${product.title} - ${product.price}</p>
          <div class="spinner">
            <button class="decrementar" data-product="${product.title}">-</button>
            <span>${product.quantity}</span>
            <button class="incrementar" data-product="${product.title}">+</button>
          </div>
        </div>
        <p class="subtotal">Subtotal: S/${subtotal}</p>
      `;
      productosSeleccionados.appendChild(productItem);
    });

    totalPagarElement.textContent = `Total a pagar: S/${totalPagar}`;
    showHTML(); // Asegurarse de que se actualiza también el contenido de containerCartProducts
  };

  //Maneja la finalización de la compra, enviando datos al servidor y actualizando la interfaz.
  btnFinalizarCompra.addEventListener('click', (event) => {
    event.preventDefault(); // Prevenir el comportamiento predeterminado

    const productos = [];

    allProducts.forEach(product => {
      productos.push({
        cantidad: product.quantity,
        id_producto: product.id
      });
    });

    // Enviar los datos al servidor usando fetch
    const formData = {
      productos: productos
    };
    fetch('clienteProductos.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    })
      .then(response => response.json())  // Asegúrate de que esperas una respuesta JSON
      .then(data => {
        textoMensaje.innerHTML = `${data.message}<br>`;
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante
      })
      .catch(error => {
        console.error('Error:', error);
        textoMensaje.innerHTML = `Error en la compra. Por favor, intente nuevamente.`;
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante
      });

    allProducts = [];
    containerCartProducts.classList.add('hidden-cart');
    productosSeleccionados.innerHTML = '';
    totalPagarElement.textContent = 'Total a pagar: S/0';
    cartEmpty.classList.remove('hidden');
    rowProduct.classList.add('hidden');
    cartTotal.classList.add('hidden');
    valorTotal.innerText = 'Total: S/0';
    countProducts.innerText = '0';
    metodoPagoTarjeta.classList.add('hidden');
    formularioPagoContainer.classList.add('hidden');
  });

  btnCancelarPago.addEventListener('click', () => {
    metodoPagoTarjeta.classList.add('hidden');
  });
  //Maneja los clics en los botones de incrementar/decrementar cantidades de productos.
  productosSeleccionados.addEventListener('click', e => {
    if (e.target.classList.contains('incrementar')) {
      const productName = e.target.getAttribute('data-product');
      allProducts.forEach(product => {
        if (product.title === productName) {
          product.quantity++;
        }
      });
      actualizarProductosSeleccionados();
    } else if (e.target.classList.contains('decrementar')) {
      const productName = e.target.getAttribute('data-product');
      allProducts.forEach(product => {
        if (product.title === productName && product.quantity > 1) {
          product.quantity--;
        }
      });
      actualizarProductosSeleccionados();
    }
  });
 
});

//Selecciona elementos relacionados con el carrito y crea un array para almacenar productos.
const cartInfo = document.querySelector('.cart-product');
const rowProduct = document.querySelector('.row-product');
const productsList = document.querySelector('#product-cards');
const valorTotal = document.querySelector('.total-pagar');
const countProducts = document.querySelector('#contador-productos');
const cartEmpty = document.querySelector('.cart-empty');
const cartTotal = document.querySelector('.cart-total');
let allProducts = [];

productsList.addEventListener('click', e => {
  if (e.target.classList.contains('btn-add-cart')) {
    const product = e.target.parentElement.parentElement; // Obtener el elemento <div> con la clase 'card'
    const infoProduct = {
      quantity: 1,
      title: product.querySelector('h3').textContent,
      price: product.querySelector('h6').textContent,
      id: product.dataset.productId 
    };
    const exists = allProducts.some(product => product.id === infoProduct.id);// si ya existe un producto con el mismo id en el array
    if (exists) {
      // Crea un nuevo array products mapeando allProducts. Si encuentra el producto existente, incrementa su cantidad. Si no, devuelve el producto sin cambios.
      const products = allProducts.map(product => {
        if (product.id === infoProduct.id) {
          product.quantity++;
          return product;
        } else {
          return product;
        }
      });
      allProducts = [...products];//Actualiza allProducts con el nuevo array de productos.
    } else {
      allProducts = [...allProducts, infoProduct];//Si el producto no existía en el carrito, lo agrega al final del array allProducts.
    }
    showHTML();
  }
});
//Para eliminar productos del carrito
rowProduct.addEventListener('click', e => {
  if (e.target.classList.contains('bx-x-circle')) {
    const product = e.target.parentElement;// obtiene el elemento padre del icono, el contenedor del producto completo en el carrito
    const title = product.querySelector('h3').textContent;
    allProducts = allProducts.filter(product => product.title !== title);
    showHTML();
  }
});

const showHTML = () => {
  if (!allProducts.length) {//Muestra el mensaje de carrito vacío y oculta la lista de productos y el total.
    cartEmpty.classList.remove('hidden');
    rowProduct.classList.add('hidden');
    cartTotal.classList.add('hidden');
  } else {//Oculta el mensaje de carrito vacío y muestra la lista de productos y el total.
    cartEmpty.classList.add('hidden');
    rowProduct.classList.remove('hidden');
    cartTotal.classList.remove('hidden');
  }

  rowProduct.innerHTML = '';//Limpia el contenido actual de la lista de productos.
  let total = 0;
  let totalOfProducts = 0;
  //Itera sobre cada producto en allProducts.
  allProducts.forEach(product => {
    const containerProduct = document.createElement('div');
    containerProduct.classList.add('cart-product');
    containerProduct.innerHTML = `
      <div class="info-cart-product">
        <h6 class="cantidad-producto-carrito">${product.quantity}</h6>
        <h3 class="titulo-producto-carrito">${product.title}</h3>
        <h6 class="precio-producto-carrito">${product.price}</h6>
      </div>
      <i class='bx bx-x-circle'></i>
    `;
    rowProduct.append(containerProduct);//Añade el contenedor del producto a la lista de productos en el carrito.
    total += parseInt(product.quantity * product.price.slice(2));
    totalOfProducts += product.quantity;
  });
  valorTotal.innerText = `Total: S/${total}`;
  countProducts.innerText = totalOfProducts;
};

botonAceptar.addEventListener('click', () => {
  mensajeFlotante.style.display = 'none';
});
