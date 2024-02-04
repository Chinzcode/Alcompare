import {DOMReady} from "../../util/Typescript/DomReady";

class Test {
    greeting: string;

    constructor(message: string) {
        this.greeting = message;
        console.log(this.greet());
    }

    greet() {
        return "Hello, " + this.greeting;
    }
}

DOMReady(() => {
	const element = document.querySelector('.js-test');
	if (element instanceof HTMLElement) {
        new Test("Daniel");
	}
});
