import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent {
  title: String = 'testapp';
  note: number = null;


  setNote = (note: any) => {
    this.note = note;
  }
}