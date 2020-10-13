import {Component, EventEmitter, OnInit, Output} from '@angular/core';

@Component({
    selector: 'app-burger-menu',
    templateUrl: './burger-menu.component.html',
    styleUrls: ['./burger-menu.component.scss']
})
export class BurgerMenuComponent implements OnInit {


    @Output() sidebar = new EventEmitter<boolean>();

    state: boolean

    constructor() {
    }

    ngOnInit(): void {
        this.state = false;
    }

    toggleVisibility(){
        this.state = !this.state;
        this.sidebar.emit(this.state)
    }



}
