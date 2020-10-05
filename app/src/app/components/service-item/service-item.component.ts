import {Component, Input, OnInit} from '@angular/core';
import {IService} from "../../models/models";

@Component({
  selector: 'app-service-item',
  templateUrl: './service-item.component.html',
  styleUrls: ['./service-item.component.scss']
})
export class ServiceItemComponent implements OnInit {

    @Input() services: IService[];

  constructor() { }

  ngOnInit(): void {
  }

}
