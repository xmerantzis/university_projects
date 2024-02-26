% source A
sourceA = randn(10000,1);

for n = 2:4
    [xq, centers, D] = lloydMaxQuantizer(sourceA, n, -1, 1);
    %convert digitized output
    digitalSourceA = centers(xq);
    digitalSourceA = digitalSourceA';
    %Calculate SQNR
    SQNR = (mean(sourceA.^2))/D(end);
    %Calculate MSE
    MSE = immse(digitalSourceA, sourceA);
    fprintf('SQNR of %d-bit Lloyd-Max quantization is %f dBs\n', n, SQNR);
    fprintf('MSE of %d-bit Lloyd-Max quantization is %f\n', n, MSE);
end



plot(sourceA, 'DisplayName', 'sourceA');
hold on;
plot(digitalSourceA, 'DisplayName', 'new_array');
hold off;

for n = 2:4
    [idx, C, sumd] = kmeans(sourceA, n);
    %convert digitized output
    C = C';
    digitalSourceA = C(idx);
    digitalSourceA = digitalSourceA';
    %Calculate SQNR
    Dist = min(sumd)/length(sourceA);
    SQNR = (mean(sourceA.^2))/Dist;
    %Calculate MSE
    MSE = immse(digitalSourceA, sourceA);
    fprintf('SQNR of %d-bit Kmeans quantization is %f dBs\n', n, SQNR);
    fprintf('MSE of %d-bit kmeans quantization is %f\n', n, MSE);
end