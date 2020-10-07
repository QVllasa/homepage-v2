import {Component, Input, OnInit} from '@angular/core';
import {ITestimonial} from "../../models/models";
import {OwlOptions} from "ngx-owl-carousel-o";
declare let $: any;

@Component({
  selector: 'app-testimonial-item',
  templateUrl: './testimonial-item.component.html',
  styleUrls: ['./testimonial-item.component.scss']
})
export class TestimonialItemComponent implements OnInit {

    @Input()testimonials: ITestimonial[];

    customOptions: OwlOptions = {
        loop: true,
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        dots: false,
        navSpeed: 700,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 2
            },
            740: {
                items: 3
            },
            940: {
                items: 4
            }
        },
        nav: true
    }


  constructor() { }

  ngOnInit(): void {
  }

}
