from Sistema import Product, Provider, Order, Invoice, Inventory

import tkinter as tk
from tkinter import messagebox, simpledialog, StringVar, Listbox, Scrollbar, Toplevel, Entry, Label, Button

class InventoryApp:
    def __init__(self, master):
        self.master = master
        self.master.title("Sistema de Inventario")
        
        self.inventory = Inventory()  # Corrige la inicialización de Inventory

        self.frame = tk.Frame(self.master)
        self.frame.pack(padx=10, pady=10)

        self.lbl_id = Label(self.frame, text="ID:")
        self.lbl_id.grid(row=0, column=0)
        self.entry_id = Entry(self.frame)
        self.entry_id.grid(row=0, column=1)

        self.lbl_name = Label(self.frame, text="Nombre:")
        self.lbl_name.grid(row=1, column=0)
        self.entry_name = Entry(self.frame)
        self.entry_name.grid(row=1, column=1)

        self.lbl_price = Label(self.frame, text="Precio:")
        self.lbl_price.grid(row=2, column=0)
        self.entry_price = Entry(self.frame)
        self.entry_price.grid(row=2, column=1)

        self.add_product_button = Button(self.frame, text="Agregar Producto", command=self.add_product)
        self.add_product_button.grid(row=3, columnspan=2)

        self.lbl_products = Label(self.frame, text="Productos:")
        self.lbl_products.grid(row=4, column=0)
        self.listbox_products = Listbox(self.frame, height=6, width=50)
        self.listbox_products.grid(row=5, columnspan=2)
        self.scrollbar = Scrollbar(self.frame, command=self.listbox_products.yview)
        self.scrollbar.grid(row=5, column=2, sticky='nsew')
        self.listbox_products.config(yscrollcommand=self.scrollbar.set)

        self.update_product_list()

    def add_product(self):
        product_id = self.entry_id.get()
        name = self.entry_name.get()
        try:
            price = float(self.entry_price.get())
        except ValueError:
            messagebox.showerror("Error", "Introduce un precio válido.")
            return

        product = Product(product_id, name, price)
        self.inventory.add_product(product)
        self.update_product_list()

        self.entry_id.delete(0, 'end')
        self.entry_name.delete(0, 'end')
        self.entry_price.delete(0, 'end')

    def update_product_list(self):
        self.listbox_products.delete(0, 'end')
        for product in self.inventory.products:
            self.listbox_products.insert('end', f'{product.id} - {product.name} - ${product.price}')

def main():
    root = tk.Tk()
    app = InventoryApp(root)
    root.mainloop()

if __name__ == '__main__':
    main()
