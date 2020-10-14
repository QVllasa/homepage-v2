import {Component, Input, OnInit} from '@angular/core';
import {IService} from "../../models/models";
import {environment} from "../../../environments/environment";
import {scaleFadeIn400ms} from "../animations/scale-fade-in.animation";

@Component({
  selector: 'app-service-item',
  templateUrl: './service-item.component.html',
  styleUrls: ['./service-item.component.scss'],
    animations: [
        scaleFadeIn400ms
    ]
})
export class ServiceItemComponent implements OnInit {

    @Input() services: IService[];
    serverPath = environment.apiUrl

  constructor() { }

  ngOnInit(): void {
  }

}
