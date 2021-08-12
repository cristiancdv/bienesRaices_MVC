/// <reference types="cypress" />

describe("prueba la navegacion y el routing del header y el footer", () => {
  it("prueba la navegacion del headr", () => {
    cy.visit("/");
    cy.get('[data-cy="navegacion-header"]').should("exist");
    cy.get('[data-cy="navegacion-header"]')
      .should("have.prop", "class")
      .should("equal", "navegacion");
    cy.get('[data-cy="navegacion-header"]').find("a").should("have.length", 5);
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .should("not.have.length", 4);

    //revisando enlaces
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(0)
      .invoke("attr", "href")
      .should("equal", "/nosotros");
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(0)
      .invoke("text")
      .should("equal", "Nosotros");

    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(1)
      .invoke("attr", "href")
      .should("equal", "/propiedades");
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(1)
      .invoke("text")
      .should("equal", "Propiedades");

    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(2)
      .invoke("attr", "href")
      .should("equal", "/blogs");
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(2)
      .invoke("text")
      .should("equal", "Blog");

    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(3)
      .invoke("attr", "href")
      .should("equal", "/contacto");
    cy.get('[data-cy="navegacion-header"]')
      .find("a")
      .eq(3)
      .invoke("text")
      .should("equal", "Contacto");
  });

  it("prueba la navegacion del footer", () => {
    cy.get('[data-cy="navegacion-footer"]').should("exist");
    cy.get('[data-cy="navegacion-footer"]')
      .should("have.prop", "class")
      .should("equal", "navegacion");
    cy.get('[data-cy="navegacion-footer"]').find("a").should("have.length", 4);
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .should("not.have.length", 5);

    //revisando enlaces
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(0)
      .invoke("attr", "href")
      .should("equal", "/nosotros");
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(0)
      .invoke("text")
      .should("equal", "Nosotros");

    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(1)
      .invoke("attr", "href")
      .should("equal", "/propiedades");
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(1)
      .invoke("text")
      .should("equal", "Propiedades");

    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(2)
      .invoke("attr", "href")
      .should("equal", "/blogs");
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(2)
      .invoke("text")
      .should("equal", "Blog");

    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(3)
      .invoke("attr", "href")
      .should("equal", "/contacto");
    cy.get('[data-cy="navegacion-footer"]')
      .find("a")
      .eq(3)
      .invoke("text")
      .should("equal", "Contacto");

    cy.get('[data-cy="copyright"]').should("exist");
    cy.get('[data-cy="copyright"]')
      .should("have.prop", "class")
      .should("equal", "copyright");
  });
});
