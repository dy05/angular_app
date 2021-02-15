import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-counter',
  templateUrl: './counter.component.html',
  styleUrls: ['./counter.component.sass']
})
export class CounterComponent implements OnInit {

  counter: number = 0;
  @Input() maxValue: number = 0;

  constructor() {}

  ngOnInit(): void {
      console.log(this.maxValue)
  }

  counterDecrement(): void {
     if (this.counter > 0) {
       this.counter--
     }
  }

  counterIncrement(): void {
   this.counter++
  }

}


