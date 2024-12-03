class Product:
    def __init__(self, id, name, price):
        self.id = id
        self.name = name
        self.price = price
        self.provider = None

    def assign_provider(self, provider):
        self.provider = provider

    def __str__(self):
        return f"ID: {self.id}, Nombre: {self.name}, Precio: {self.price}, Proveedor: {self.provider.name if self.provider else 'Ninguno'}"


class Provider:
    def __init__(self, id, name):
        self.id = id
        self.name = name

    def __str__(self):
        return f"ID: {self.id}, Nombre: {self.name}"


class Invoice:
    def __init__(self, id, products):
        self.id = id
        self.products = products

    def total_price(self):
        return sum(p.price for p in self.products)

    def __str__(self):
        product_details = ', '.join(p.name for p in self.products)
        return f"Factura ID: {self.id}, Productos: {product_details}, Total: ${self.total_price()}"


class Order:
    def __init__(self, id, products):
        self.id = id
        self.products = products

    def modify_order(self, new_products):
        self.products = new_products

    def __str__(self):
        product_details = ', '.join(p.name for p in self.products)
        return f"Pedido ID: {self.id}, Productos: {product_details}"


class Inventory:
    def __init__(self):
        self.products = {}
        self.providers = {}
        self.invoices = {}
        self.orders = {}

    def add_product(self, product):
        self.products[product.id] = product

    def remove_product(self, product_id):
        if product_id in self.products:
            del self.products[product_id]

    def modify_product(self, product_id, name, price):
        if product_id in self.products:
            self.products[product_id].name = name
            self.products[product_id].price = price

    def add_provider(self, provider):
        self.providers[provider.id] = provider

    def create_invoice(self, invoice_id, product_ids):
        products = [self.products[pid] for pid in product_ids if pid in self.products]
        invoice = Invoice(invoice_id, products)
        self.invoices[invoice_id] = invoice

    def create_order(self, order_id, product_ids):
        products = [self.products[pid] for pid in product_ids if pid in self.products]
        order = Order(order_id, products)
        self.orders[order_id] = order

    def modify_order(self, order_id, new_product_ids):
        if order_id in self.orders:
            new_products = [self.products[pid] for pid in new_product_ids if pid in self.products]
            self.orders[order_id].modify_order(new_products)


# Función para mostrar el menú principal
def main_menu(inventory):
    while True:
        print("\n--- Menú Principal ---")
        print("1. Agregar producto")
        print("2. Eliminar producto")
        print("3. Modificar producto")
        print("4. Asignar proveedor a producto")
        print("5. Agregar proveedor")
        print("6. Crear factura")
        print("7. Crear pedido")
        print("8. Modificar pedido")
        print("9. Salir")
        choice = input("Seleccione una opción: ")

        if choice == "1":
            id = input("Ingrese ID del producto: ")
            name = input("Ingrese nombre del producto: ")
            price = float(input("Ingrese precio del producto: "))
            inventory.add_product(Product(id, name, price))
            print("Producto agregado con éxito.")
        elif choice == "2":
            id = input("Ingrese ID del producto a eliminar: ")
            inventory.remove_product(id)
            print("Producto eliminado con éxito.")
        elif choice == "3":
            id = input("Ingrese ID del producto: ")
            name = input("Ingrese nuevo nombre del producto: ")
            price = float(input("Ingrese nuevo precio del producto: "))
            inventory.modify_product(id, name, price)
            print("Producto modificado con éxito.")
        elif choice == "4":
            product_id = input("Ingrese ID del producto: ")
            provider_id = input("Ingrese ID del proveedor: ")
            if product_id in inventory.products and provider_id in inventory.providers:
                inventory.products[product_id].assign_provider(inventory.providers[provider_id])
                print("Proveedor asignado con éxito.")
            else:
                print("Producto o proveedor no encontrado.")
        elif choice == "5":
            id = input("Ingrese ID del proveedor: ")
            name = input("Ingrese nombre del proveedor: ")
            inventory.add_provider(Provider(id, name))
            print("Proveedor agregado con éxito.")
        elif choice == "6":
            id = input("Ingrese ID de la factura: ")
            product_ids = input("Ingrese IDs de productos separados por coma: ").split(",")
            inventory.create_invoice(id, product_ids)
            print("Factura creada con éxito.")
        elif choice == "7":
            id = input("Ingrese ID del pedido: ")
            product_ids = input("Ingrese IDs de productos separados por coma: ").split(",")
            inventory.create_order(id, product_ids)
            print("Pedido creado con éxito.")
        elif choice == "8":
            id = input("Ingrese ID del pedido a modificar: ")
            new_product_ids = input("Ingrese nuevos IDs de productos separados por coma: ").split(",")
            inventory.modify_order(id, new_product_ids)
            print("Pedido modificado con éxito.")
        elif choice == "9":
            print("Saliendo del sistema...")
            break
        else:
            print("Opción no válida. Intente de nuevo.")


# Crear instancia de inventario y correr el menú
inventory = Inventory()
main_menu(inventory)


print("no se programar")
