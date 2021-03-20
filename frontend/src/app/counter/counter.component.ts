import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';

@Component({
  selector: 'app-counter',
  templateUrl: './counter.component.html',
  styleUrls: ['./counter.component.css']
})
export class CounterComponent implements OnInit {
  @Output() onFormSubmit = new EventEmitter<any>();
  counter: number = 0;
  @Input() maxValue: number = 0;

  constructor() {}

  ngOnInit(): void {
      // console.log(this.maxValue)
  }

  submitForm = (): void => {
    this.onFormSubmit.emit(this.counter);
  }

  counterDecrement = (): void => {
     if (this.counter > 0) {
       this.counter--
     }
  }

  counterIncrement = (): void => {
   this.counter++
  }

}


