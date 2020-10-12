import {AfterViewInit, Component, Input, OnInit, ViewChild} from '@angular/core';
import Typewriter from 'typewriter-effect/dist/core';
import GraphemeSplitter from "grapheme-splitter";

@Component({
  selector: 'app-type-writer',
  templateUrl: './type-writer.component.html',
  styleUrls: ['./type-writer.component.scss']
})
export class TypeWriterComponent implements OnInit, AfterViewInit {

    @Input() content: string[];

    @ViewChild('tw') typewriterElement;

  constructor() { }

  ngOnInit(): void {
  }

  ngAfterViewInit() {
      this.onStartTypeWriter();
  }

    onStartTypeWriter(){
        const stringSplitter = string => {
            const splitter = new GraphemeSplitter();
            return splitter.splitGraphemes(string);
        };
        const target = this.typewriterElement.nativeElement;
        const writer = new Typewriter(target, {
            loop: true,
            typeColor: '#fff',
            strings: this.content,
            autoStart: true,
            stringSplitter
        })

        writer.start();
    }

}
