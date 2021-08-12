/// <reference types="cypress" />

describe("prueba la pagina contacto", () => {
  it("prueba el formulario y el envio de email", () => {
    cy.visit("/contacto");
    cy.get('[data-cy="heading-contacto"]').should("exist");
    cy.get('[data-cy="heading-contacto"]')
      .invoke("text")
      .should("equal", "Contacto");

    cy.get('[data-cy="heading-contacto"]')
      .invoke("text")
      .should("not.equal", "Formulario de Contacto");

    cy.get('[data-cy="heading-formulario"]').should("exist");
    cy.get('[data-cy="heading-formulario"]')
      .invoke("text")
      .should("equal", "Llene el Formulario de Contacto");
    cy.get('[data-cy="formulario-contacto"]').should("exist");
  });
  it("llena los campos del formulario", () => {
    cy.get('[data-cy="input-nombre"]').type("Cristian Vazquez");
    cy.get('[data-cy="input-mensaje"]').type("Deseo comprar una casa");
    cy.get('[data-cy="input-opciones"]').select("Vende");
    cy.wait(500);
    cy.get('[data-cy="input-opciones"]').select("Compra");
    cy.get('[data-cy="input-precio"]').type("15000");
    cy.get('[data-cy="forma-contacto"]').eq(1).check();
    cy.get('[data-cy="input-email"]').type("cristiancdv@gmail.com");
    cy.wait(500);
    cy.get('[data-cy="forma-contacto"]').eq(0).check();
    cy.get('[data-cy="input-telefono"]').type("1134299617");
    cy.get('[data-cy="input-fecha"]').type("2021-08-06");
    cy.get('[data-cy="input-hora"]').type("15:20");

    cy.get('[data-cy="formulario-contacto"]').submit();

    cy.get('[data-cy="alerta-contacto-exito"]').should("exist");
    cy.get('[data-cy="alerta-contacto-exito"]')
      .should("have.class", "alerta")
      .and("have.class", "exito");
    cy.get('[data-cy="alerta-contacto-exito"]')
      .invoke("text")
      .should("equal", "Mensaje Enviado Correctamente");
  });
});
