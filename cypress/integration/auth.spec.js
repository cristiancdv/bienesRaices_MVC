/// <reference types="cypress" />

describe("prueba la auth", () => {
  it("prueba el bloque del login", () => {
    cy.visit("/login");

    //prueba el titulo
    cy.get('[data-cy="heading-auth"]').should("exist");
    cy.get('[data-cy="heading-auth"]')
      .invoke("text")
      .should("equal", "Iniciar Sesión");

    //prueba el error de campo vacio
    cy.get('[data-cy="formulario-auth"]').submit();
    cy.get('[ data-cy="alerta-auth-error"]').should("exist");
    cy.get('[ data-cy="alerta-auth-error"]')
      .should("have.class", "alerta")
      .and("have.class", "error");
    cy.get('[ data-cy="alerta-auth-error"]')
      .invoke("text")
      .should("equal", "el Email y Password son Obligatorios");

    //prueba el campo de usuario invalido
    cy.get('[ data-cy="input-usuario"]').type("cristiancdv@gmail.com");
    cy.get('[ data-cy="input-password"]').type("123456");
    cy.get('[data-cy="formulario-auth"]').submit();
    cy.get('[ data-cy="alerta-auth-error"]').should("exist");
    cy.get('[ data-cy="alerta-auth-error"]')
      .should("have.class", "alerta")
      .and("have.class", "error");
    cy.get('[ data-cy="alerta-auth-error"]')
      .invoke("text")
      .should("equal", "El Usuario o Contraseña no coinciden");

    //prueba el campo de password invalido
    cy.get('[ data-cy="input-usuario"]').type("correo@correo.com");
    cy.get('[ data-cy="input-password"]').type("123456");
    cy.get('[data-cy="formulario-auth"]').submit();
    cy.get('[ data-cy="alerta-auth-error"]').should("exist");
    cy.get('[ data-cy="alerta-auth-error"]')
      .should("have.class", "alerta")
      .and("have.class", "error");
    cy.get('[ data-cy="alerta-auth-error"]')
      .invoke("text")
      .should("equal", "El Usuario o Contraseña no coinciden");

    //prueba el campo de password invalido
    cy.get('[ data-cy="input-usuario"]').type("correo@correo.com");
    cy.get('[ data-cy="input-password"]').type("1234");
    cy.get('[data-cy="formulario-auth"]').submit();
  });
});
